<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardReportController extends Controller
{
    public function index()
    {
        return view('public.cert-check.index');
    }

    public function search(Request $request)
    {
        $request->validate([
            'cert_number' => 'required|string|max:20',
        ]);

        $card = \App\Models\SubmissionCard::where('cert_number', $request->cert_number)->first();

        if (!$card) {
            return back()->with('error', 'Certification number not found. Please check and try again.');
        }

        if (!$card->is_revealed) {
            return back()->with('error', 'This report is currently being prepared and is not yet available for public view.');
        }

        return redirect()->route('card.report', $card->cert_number);
    }

    public function show($cert_number)
    {
        $card = \App\Models\SubmissionCard::with(['submission.user', 'labelType'])
            ->where('cert_number', $cert_number)
            ->firstOrFail();

        if (!$card->is_revealed) {
            return view('public.cert-check.private', compact('card'));
        }

        return view('card_reports.show', compact('card'));
    }
}
