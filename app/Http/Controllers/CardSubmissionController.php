<?php

namespace App\Http\Controllers;

use App\Models\ServiceLevel;
use App\Models\Submission;
use App\Models\SubmissionType;
use App\Models\LabelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CardSubmissionController extends Controller
{
    // Step 1: Submission Name & Type
    public function index()
    {
        $types = SubmissionType::where('is_active', true)->orderBy('order')->get();

        return view('submission.step1', compact('types'));
    }

    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'submission_name' => 'required|string|max:255',
            'submission_type_id' => 'required|exists:submission_types,id',
        ]);

        $data = session('submission_data', []);
        $data['submission_name'] = $validated['submission_name'];
        $data['submission_type_id'] = $validated['submission_type_id'];

        session(['submission_data' => $data]);

        return redirect()->route('submission.step2');
    }

    // Step 2: Service Level
    public function step2()
    {
        if (! session()->has('submission_data.submission_name')) {
            return redirect()->route('submission.step1');
        }

        $levels = ServiceLevel::where('is_active', true)->orderBy('order')->get();

        return view('submission.step2', compact('levels'));
    }

    public function storeStep2(Request $request)
    {
        $validated = $request->validate([
            'service_level_id' => 'required|exists:service_levels,id',
        ]);

        $data = session('submission_data', []);
        $data['service_level_id'] = $validated['service_level_id'];

        session(['submission_data' => $data]);

        return redirect()->route('submission.step3');
    }

    // Step 3: Card Details
    public function step3()
    {
        if (! session()->has('submission_data.service_level_id')) {
            return redirect()->route('submission.step2');
        }

        $serviceLevelId = session('submission_data.service_level_id');
        $serviceLevel = ServiceLevel::find($serviceLevelId);
        $labelTypes = LabelType::where('is_active', true)->orderBy('order')->get();

        // Check if we are editing an existing submission
        $submission = null;
        if (session()->has('pending_submission_id')) {
            $submission = Submission::with('cards')->find(session('pending_submission_id'));
        }

        return view('submission.step3', compact('serviceLevel', 'labelTypes', 'submission'));
    }

    public function storeStep3(Request $request)
    {
        $data = session('submission_data');
        if (! $data) {
            return redirect()->route('submission.step1');
        }

        $serviceLevel = ServiceLevel::find($data['service_level_id']);
        $minCards = $serviceLevel->min_submission ?? 0;

        $validated = $request->validate([
            'card_entry_mode' => 'required|in:easy,detailed',
            'label_type_id' => 'nullable|exists:label_types,id',
            'total_cards' => 'nullable',
            'cards' => 'nullable|array',
            'cards.*.qty' => 'sometimes|integer|min:1',
            'cards.*.title' => 'sometimes|string|max:255',
            'cards.*.label_type_id' => 'nullable|exists:label_types,id',
        ]);

        $count = $request->card_entry_mode === 'easy' ? (int)($request->total_cards ?? 0) : count($request->cards ?? []);
        
        // Custom validation for min cards
        if ($minCards > 0 && $count < $minCards) {
            $errorField = $request->card_entry_mode === 'easy' ? 'total_cards' : 'cards';
            return back()->withErrors([$errorField => "The selected service level requires a minimum of {$minCards} cards. You have currently added {$count} cards."])->withInput();
        }

        // Custom validation for easy mode
        if ($validated['card_entry_mode'] === 'easy' && empty($validated['total_cards'])) {
            return back()->withErrors(['total_cards' => 'Please enter total card count for easy mode.'])->withInput();
        }

        // Custom validation for detailed mode
        if ($validated['card_entry_mode'] === 'detailed') {
            if (empty($validated['cards']) || count($validated['cards']) === 0) {
                return back()->withErrors(['cards' => 'Please add at least one card for detailed mode.'])->withInput();
            }
            foreach ($validated['cards'] as $index => $card) {
                if (empty($card['title'])) {
                    return back()->withErrors(["cards.{$index}.title" => 'Card title is required.'])->withInput();
                }
            }
        }

        // Create or Update Submission
        return DB::transaction(function () use ($data, $request) {
            $cookieId = request()->cookie('guest_id') ?? (string) Str::uuid();
            $submissionId = session('pending_submission_id');
            
            $submissionData = [
                'user_id' => auth()->id(),
                'temp_guest_id' => auth()->check() ? null : $cookieId,
                'guest_name' => $data['submission_name'],
                'submission_type_id' => $data['submission_type_id'],
                'service_level_id' => $data['service_level_id'],
                'label_type_id' => $request->card_entry_mode === 'easy' ? $request->label_type_id : null,
                'status' => 'draft',
                'card_entry_mode' => $request->card_entry_mode,
                'total_cards' => ($request->card_entry_mode === 'easy' ? (int)$request->total_cards : count($request->cards ?? [])),
            ];

            if ($submissionId) {
                $submission = Submission::find($submissionId);
                
                // Force new 6-digit ID if it's an old-style one (e.g., contains 'SUB-')
                if (str_contains($submission->submission_no, '-')) {
                    do {
                        $newNo = (string) rand(100000, 999999);
                    } while (Submission::where('submission_no', $newNo)->exists());
                    $submissionData['submission_no'] = $newNo;
                }
                
                $submission->update($submissionData);
                $submission->cards()->delete();
            } else {
                do {
                    $newNo = (string) rand(100000, 999999);
                } while (Submission::where('submission_no', $newNo)->exists());
                
                $submissionData['submission_no'] = $newNo;
                $submission = Submission::create($submissionData);
                session(['pending_submission_id' => $submission->id]);
            }

            // Save Cards if detailed
            if ($request->card_entry_mode === 'detailed' && ! empty($request->cards)) {
                foreach ($request->cards as $card) {
                    $submission->cards()->create([
                        'qty' => $card['qty'] ?? 1,
                        'title' => $card['title'],
                        'set_name' => $card['set_name'] ?? null,
                        'year' => $card['year'] ?? null,
                        'card_number' => $card['card_number'] ?? null,
                        'lang' => $card['lang'] ?? null,
                        'notes' => $card['notes'] ?? null,
                        'label_type_id' => $card['label_type_id'] ?? null,
                    ]);
                }
            }

            // Queue cookie if needed
            if (! auth()->check()) {
                cookie()->queue('guest_id', $cookieId, 60 * 24 * 30);
            }

            // Redirect based on auth status
            if (auth()->check()) {
                return redirect()->route('submission.step4');
            }

            return redirect()->route('login')->with('status', 'Please log in to complete your submission.');
        });
    }

    public function step4()
    {
        $submissionId = session('pending_submission_id');
        if (!$submissionId) {
            if (auth()->check()) {
                $latest = Submission::where('user_id', auth()->id())->where('status', 'draft')->latest()->first();
                if ($latest) {
                    session(['pending_submission_id' => $latest->id]);
                    $submissionId = $latest->id;
                } else {
                    return redirect()->route('submission.step1');
                }
            } else {
                return redirect()->route('submission.step1');
            }
        }

        $submission = Submission::with('shippingAddress')->findOrFail($submissionId);
        
        // Priority: 1. Submission's own address, 2. User's latest address
        $shippingAddress = $submission->shippingAddress;
        if (!$shippingAddress && auth()->check()) {
            $shippingAddress = \App\Models\ShippingAddress::where('user_id', auth()->id())->latest()->first();
        }

        return view('submission.step4', compact('shippingAddress'));
    }

    public function storeStep4(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'number' => 'required|string|max:20',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'county' => 'nullable|string|max:100',
            'post_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
        ]);

        $submissionId = session('pending_submission_id');
        $submission = Submission::findOrFail($submissionId);

        if ($submission->shipping_address_id) {
            // Update existing address
            $submission->shippingAddress->update($validated);
        } else {
            // Create new address and link it
            $address = \App\Models\ShippingAddress::create(array_merge($validated, ['user_id' => auth()->id()]));
            $submission->update(['shipping_address_id' => $address->id]);
        }

        return redirect()->route('submission.step5');
    }

    public function step5()
    {
        if (! session()->has('pending_submission_id')) {
            return redirect()->route('submission.step1');
        }

        $submissionId = session('pending_submission_id');
        $submission = Submission::with([
            'submissionType', 
            'serviceLevel', 
            'labelType', 
            'cards', 
            'cards.labelType', 
            'shippingAddress', 
            'user'
        ])->findOrFail($submissionId);

        // Security check: ensure submission belongs to logged in user if auth
        if (auth()->check() && $submission->user_id !== auth()->id()) {
            abort(403);
        }

        return view('submission.step5', compact('submission'));
    }

    public function step6()
    {
        if (! session()->has('pending_submission_id')) {
            return redirect()->route('submission.step1');
        }
        
        $submissionId = session('pending_submission_id');
        $submission = Submission::with(['serviceLevel', 'labelType', 'cards.labelType'])->findOrFail($submissionId);
        
        return view('submission.payment', [
            'submission' => $submission,
            'stripeKey' => env('STRIPE_KEY'),
        ]);
    }
    
    public function processPayment(Request $request)
    {
        $submissionId = session('pending_submission_id');
        if (! $submissionId) {
            return redirect()->route('submission.step1');
        }

        $submission = Submission::with(['serviceLevel', 'submissionType', 'labelType', 'cards.labelType'])->findOrFail($submissionId);

        // Map cards to Stripe line items
        $lineItems = [];
        $totalCost = 0;

        if ($submission->card_entry_mode === 'detailed') {
            foreach ($submission->cards as $card) {
                $labelCost = $card->labelType?->price_adjustment ?? 0;
                $unitAmount = ($submission->serviceLevel->price_per_card + $labelCost);
                $totalCost += $unitAmount * ($card->qty ?? 1);

                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $card->title,
                            'description' => ($card->set_name ? $card->set_name . ' ' : '') . ($card->card_number ? '#' . $card->card_number : '') . " | Label: " . ($card->labelType->name ?? 'Standard'),
                        ],
                        'unit_amount' => round($unitAmount * 100),
                    ],
                    'quantity' => $card->qty ?? 1,
                ];
            }
        } else {
            // Easy Mode
            $labelCost = $submission->labelType?->price_adjustment ?? 0;
            $unitAmount = ($submission->serviceLevel->price_per_card + $labelCost);
            $totalCost += $unitAmount * $submission->total_cards;

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => "Grading Fee ({$submission->total_cards} Cards)",
                        'description' => "Service Level: {$submission->serviceLevel->name} | Label: " . ($submission->labelType->name ?? 'Standard'),
                    ],
                    'unit_amount' => round($unitAmount * 100),
                ],
                'quantity' => $submission->total_cards,
            ];
        }

        // Add Flat Rate Shipping
        $shippingRate = (float) \App\Models\SiteSetting::get('return_shipping_fee', 7.99);
        $submission->update(['shipping_amount' => $shippingRate]);

        $lineItems[] = [
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => 'Return Shipping (Flat Rate)',
                    'description' => 'Secure shipping for your collection',
                ],
                'unit_amount' => round($shippingRate * 100),
            ],
            'quantity' => 1,
        ];

        try {
             \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('submission.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('submission.cancel'),
                'metadata' => [
                    'submission_id' => $submission->id,
                    'submission_no' => $submission->submission_no,
                ],
            ]);

            return redirect($session->url);

        } catch (\Exception $e) {
            return back()->with('error', 'Error starting payment: ' . $e->getMessage());
        }
    }

    public function paymentSuccess(Request $request)
    {
        $submissionId = session('pending_submission_id');
        if (! $submissionId) {
             $route = (auth()->check() && auth()->user()->role === 'admin') ? 'admin.dashboard' : 'user.dashboard';
             return redirect()->route($route);
        }

        $submission = Submission::with(['user', 'serviceLevel', 'submissionType', 'cards', 'shippingAddress'])->findOrFail($submissionId);
        $submission->update(['status' => 'paid']);

        // Generate Certification Numbers and QR Tokens for each card
        if ($submission->card_entry_mode === 'easy') {
            // In easy mode, we create the skeleton records if they don't exist
            // (Wait, easy mode cards might not exist in submission_cards if it's bulk)
            // If they don't exist, we create them based on total_cards
            if ($submission->cards->count() === 0) {
                for ($i = 0; $i < $submission->total_cards; $i++) {
                    $submission->cards()->create([
                        'title' => 'Card #' . ($i + 1),
                        'qty' => 1,
                        'status' => 'Submission Complete',
                    ]);
                }
                $submission->load('cards');
            }
        }

        foreach ($submission->cards as $card) {
            if (!$card->cert_number) {
                do {
                    $cert = rand(100000, 999999);
                } while (\App\Models\SubmissionCard::where('cert_number', $cert)->exists());
                
                $card->update([
                    'cert_number' => $cert,
                    'qr_code_token' => Str::random(32),
                ]);
            }
        }

        // Send Notification Email and Database Notification to Admin
        try {
            $adminEmail = \App\Models\SiteSetting::get('admin_notification_email', 'admin@valengrading.com');
            \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\AdminNewOrderNotification($submission));
            
            // Send Database Notification to all admins
            $admins = \App\Models\User::where('role', 'admin')->get();
            \Illuminate\Support\Facades\Notification::send($admins, new \App\Notifications\NewSubmissionNotification($submission));
            
            // Broadcast real-time notification
            event(new \App\Events\NewSubmissionEvent($submission));

            // Send User Confirmation Email
            $userEmail = $submission->user->email ?? $submission->shippingAddress->email;
            if ($userEmail) {
                \Illuminate\Support\Facades\Mail::to($userEmail)->send(new \App\Mail\UserSubmissionConfirmation($submission));
            }
        } catch (\Exception $e) {
            \Log::error('Failed to send admin notification: ' . $e->getMessage());
        }

        // Keep ID in session for success page refresh but forget after use OR just pass in request
        // session()->forget('pending_submission_id');
        session()->forget('submission_data');

        return view('submission.success', compact('submission'));
    }

    public function downloadPackingSlip($id)
    {
        $submission = Submission::with(['user', 'serviceLevel', 'submissionType', 'cards', 'shippingAddress'])->findOrFail($id);
        
        // Basic security check: user must own it or be admin
        if (auth()->id() !== $submission->user_id && auth()->user()->role !== 'admin') {
            abort(403);
        }

        // Prevent download for draft submissions
        if ($submission->status === 'draft') {
            abort(403, 'Packing slips cannot be generated for draft submissions.');
        }

        return view('submission.packing_slip', compact('submission'));
    }

    public function paymentCancel()
    {
        return redirect()->route('submission.step6')->with('error', 'Payment was cancelled.');
    }
}
