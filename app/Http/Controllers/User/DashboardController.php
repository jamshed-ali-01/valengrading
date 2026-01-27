<?php

namespace App\Http\Controllers\User;

class DashboardController
{
    public function index()
    {
        $submissions = \App\Models\Submission::where('user_id', auth()->id())
            ->with(['serviceLevel', 'cards.labelType'])
            ->latest()
            ->get();

        $stats = [
            'total_submissions' => $submissions->count(),
            'total_cards' => $submissions->sum(function($s) {
                return $s->card_entry_mode === 'detailed' ? $s->cards->sum('qty') : $s->total_cards;
            }),
            'active_orders' => $submissions->whereNotIn('status', ['completed', 'cancelled', 'draft'])->count(),
        ];

        return view('user.dashboard', compact('submissions', 'stats'));
    }
}
