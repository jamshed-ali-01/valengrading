<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index()
    {
        $submissions = Submission::with(['user', 'serviceLevel', 'submissionType'])
            ->latest()
            ->paginate(20);

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

    public function destroy(Submission $submission)
    {
        $submission->delete();
        return redirect()->route('admin.submissions.index')->with('success', 'Submission deleted successfully.');
    }
}
