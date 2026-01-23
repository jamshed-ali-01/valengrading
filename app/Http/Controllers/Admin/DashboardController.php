<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_submissions' => \App\Models\Submission::count(),
            'pending_payments' => \App\Models\Submission::where('status', 'pending_payment')->count(),
            'paid_submissions' => \App\Models\Submission::where('status', 'paid')->count(),
            'recent_submissions' => \App\Models\Submission::with(['user', 'serviceLevel'])->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
