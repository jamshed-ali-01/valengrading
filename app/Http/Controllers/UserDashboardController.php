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
            ->with(['serviceLevel', 'submissionType', 'labelType'])
            ->latest()
            ->get();

        $myCards = SubmissionCard::whereHas('submission', function ($query) use ($user) {
            $query->where('user_id', $user->id);
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
}
