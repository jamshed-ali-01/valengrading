<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index(Request $request)
    {
        $submissions = Submission::with(['user', 'serviceLevel', 'submissionType', 'cards', 'labelType'])
            ->latest()
            ->get();

        return view('admin.submissions.index', compact('submissions'));
    }

    public function show(Submission $submission)
    {
        $submission->load(['user', 'serviceLevel', 'submissionType', 'labelType', 'cards.labelType', 'shippingAddress']);
        return view('admin.submissions.show', compact('submission'));
    }

    public function updateStatus(Request $request, Submission $submission)
    {
        $request->validate([
            'status' => 'required|in:draft,pending_payment,order_received,processing,shipped,completed,cancelled',
        ]);

        $submission->update(['status' => $request->status]);

        return back()->with('success', 'Submission status updated successfully.');
    }

    public function editCard(\App\Models\SubmissionCard $card)
    {
        $card->load('submission');
        $statuses = [
            'Submission Complete', 
            'Cards Received', 
            'In Grading', 
            'Label Creation', 
            'Slabbed', 
            'Quality Control', 
            'Completed', 
            'Shipped', 
            'Delivered'
        ];
        return view('admin.submissions.cards.edit', compact('card', 'statuses'));
    }

    public function updateCard(Request $request, \App\Models\SubmissionCard $card)
    {
        $request->validate([
            'status' => 'required|string|max:255',
            'grade' => 'nullable|string|max:255',
            'centering' => 'nullable|numeric|min:0|max:10',
            'corners' => 'nullable|numeric|min:0|max:10',
            'edges' => 'nullable|numeric|min:0|max:10',
            'surface' => 'nullable|numeric|min:0|max:10',
            'grading_insights' => 'nullable|string',
            'is_revealed' => 'nullable|boolean',
            'grading_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000',
            'back_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000',
            'admin_notes' => 'nullable|string',
        ]);

        $data = $request->only([
            'status', 'grade', 'centering', 'corners', 'edges', 'surface', 
            'grading_insights', 'admin_notes'
        ]);

        $data['is_revealed'] = $request->has('is_revealed');

        if ($request->hasFile('grading_image')) {
            $path = $request->file('grading_image')->store('grading_images', 'public');
            $data['grading_image'] = $path;
        }

        if ($request->hasFile('back_image')) {
            $path = $request->file('back_image')->store('grading_images', 'public');
            $data['back_image'] = $path;
        }

        // Ensure cert_number and qr_code_token exist
        if (!$card->cert_number) {
            do {
                $cert = rand(100000, 999999);
            } while (\App\Models\SubmissionCard::where('cert_number', $cert)->exists());
            $data['cert_number'] = $cert;
        }

        if (!$card->qr_code_token) {
            $data['qr_code_token'] = \Illuminate\Support\Str::random(32);
        }

        $card->update($data);

        return redirect()->route('admin.submissions.show', $card->submission_id)
            ->with('success', 'Card details updated successfully.');
    }

    public function storeCard(Request $request, Submission $submission)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
            'title' => 'required|string|max:255',
            'set_name' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:4',
            'card_number' => 'nullable|string|max:50',
            'lang' => 'nullable|string|max:50',
            'label_type_id' => 'nullable|exists:label_types,id',
        ]);

        // Enforcement for Easy Mode limit
        if ($submission->card_entry_mode === 'easy') {
            $currentCount = $submission->cards()->sum('qty');
            $remaining = $submission->total_cards - $currentCount;
            
            if ($request->qty > $remaining) {
                return back()->withErrors(['qty' => "Cannot add {$request->qty} cards. Only {$remaining} cards remaining for this submission."])->withInput();
            }
        }

        for ($i = 0; $i < $request->qty; $i++) {
            do {
                $cert = rand(100000, 999999);
            } while (\App\Models\SubmissionCard::where('cert_number', $cert)->exists());

            $submission->cards()->create([
                'qty' => 1,
                'title' => $request->title,
                'set_name' => $request->set_name,
                'year' => $request->year,
                'card_number' => $request->card_number,
                'lang' => $request->lang,
                'label_type_id' => $request->label_type_id ?? $submission->label_type_id,
                'status' => 'Cards Received',
                'cert_number' => $cert,
                'qr_code_token' => \Illuminate\Support\Str::random(32),
            ]);
        }

        return back()->with('success', 'Card(s) added successfully.');
    }

    public function destroy(Submission $submission)
    {
        $submission->delete();
        return redirect()->route('admin.submissions.index')->with('success', 'Submission deleted successfully.');
    }
}
