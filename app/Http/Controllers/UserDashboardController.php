<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Submission;
use App\Models\SubmissionCard;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // fetch Logic
        $submissions = Submission::where('user_id', $user->id)
            ->where('status', '!=', 'draft') // Filter out drafts
            ->with(['serviceLevel', 'submissionType', 'labelType'])
            ->latest()
            ->get();

        $myCards = SubmissionCard::whereHas('submission', function ($query) use ($user) {
            $query->where('user_id', $user->id)->where('status', '!=', 'draft');
        })->latest()->get();

        // Calculate Stats
        $totalSubmissions = $submissions->count();
        $cardsGraded = $myCards->whereNotNull('grade')->count();
        $inProgress = $submissions->where('status', '!=', 'completed')->count(); // Assuming 'completed' is the final status
        
        // precise total spent calculation could be complex, for now sum shipping + service level cost manually or use a helper if available
        // The Submission model has getTotalCostAttribute but it might be heavy to loop all.
        // Let's use the attribute since we have the collection.
        $totalSpent = $submissions->sum(function ($submission) {
             return $submission->total_cost;
        });

        // Overview specific counts
        $cardsCompletedToday = $myCards->whereNotNull('grade')->where('updated_at', '>=', now()->subDay())->count(); // Example metric
        
        $latestAddress = \App\Models\ShippingAddress::where('user_id', $user->id)->latest()->first();

        return view('user.dashboard', compact(
            'user',
            'submissions',
            'myCards',
            'totalSubmissions',
            'cardsGraded',
            'inProgress',
            'totalSpent',
            'latestAddress'
        ));
    }

    public function updateInfo(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:20',
        ]);

        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update phone in latest address or create new if not exists (simplified logic for now)
        // Ideally User model should have phone, but instructions say map to ShippingAddress number
        $address = \App\Models\ShippingAddress::where('user_id', $user->id)->latest()->first();
        if ($address) {
            $address->update(['number' => $request->phone]);
        }

        return back()->with('success', 'Personal information updated successfully.');
    }

    public function updateAddress(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address_line_1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'county' => 'nullable|string|max:255',
            'post_code' => 'required|string|max:20',
            'country' => 'required|string|max:255',
        ]);

        // Find the user's latest address or create a new one
        $address = \App\Models\ShippingAddress::where('user_id', auth()->id())->latest()->first();

        if ($address) {
            $address->update([
                'full_name' => $request->full_name,
                'number' => $request->phone,
                'address_line_1' => $request->address_line_1,
                'city' => $request->city,
                'county' => $request->county,
                'post_code' => $request->post_code,
                'country' => $request->country,
                'email' => auth()->user()->email, // Keep email synced with user
            ]);
        } else {
             \App\Models\ShippingAddress::create([
                'user_id' => auth()->id(),
                'full_name' => $request->full_name,
                'number' => $request->phone,
                'address_line_1' => $request->address_line_1,
                'city' => $request->city,
                'county' => $request->county,
                'post_code' => $request->post_code,
                'country' => $request->country,
                'email' => auth()->user()->email,
            ]);
        }

        return back()->with('success', 'Delivery address updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        auth()->user()->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }
}
