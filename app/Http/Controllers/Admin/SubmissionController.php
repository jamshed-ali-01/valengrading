<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index()
    {
        $submissions = Submission::with(['user', 'serviceLevel', 'submissionType', 'cards', 'labelType'])
            ->latest()
            ->paginate(10);

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
            'status' => 'required|in:draft,pending_payment,paid,processing,shipped,completed,cancelled',
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
            'admin_notes' => 'nullable|string',
        ]);

        $card->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

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

        $submission->cards()->create([
            'qty' => $request->qty,
            'title' => $request->title,
            'set_name' => $request->set_name,
            'year' => $request->year,
            'card_number' => $request->card_number,
            'lang' => $request->lang,
            'label_type_id' => $request->label_type_id ?? $submission->label_type_id, // Default to submission label type
            'status' => 'Cards Received', // Default status for admin added cards
        ]);

        return back()->with('success', 'Card added successfully.');
    }

    public function destroy(Submission $submission)
    {
        $submission->delete();
        return redirect()->route('admin.submissions.index')->with('success', 'Submission deleted successfully.');
    }
}
