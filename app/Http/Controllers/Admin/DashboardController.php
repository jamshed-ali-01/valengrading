<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Submission;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Basic stats
        $stats = [
            'total_users' => User::count(),
            'total_submissions' => Submission::count(),
            'received_submissions' => Submission::where('status', '!=', 'draft')->count(),
            'draft_submissions' => Submission::where('status', 'draft')->count(),
            'pending_payments' => Submission::where('status', 'pending_payment')->count(),
            'paid_submissions' => Submission::where('status', 'paid')->orWhere('status', 'processing')->orWhere('status', 'completed')->count(),
            'recent_submissions' => Submission::with(['user', 'serviceLevel'])
                ->latest()
                ->limit(10)
                ->get(),
            'total_cards' => Submission::whereIn('status', ['paid', 'processing', 'completed'])
                ->sum('total_cards'),
        ];

        // Calculate monthly revenue for last 12 months
        $endDate = Carbon::now()->endOfMonth();
        $startDate = Carbon::now()->subMonths(11)->startOfMonth();

        $monthlyRevenue = Submission::select(
            DB::raw('YEAR(submissions.created_at) as year'),
            DB::raw('MONTH(submissions.created_at) as month'),
            DB::raw('SUM(total_cards * service_levels.price_per_card) as revenue')
        )
        ->join('service_levels', 'submissions.service_level_id', '=', 'service_levels.id')
        ->whereIn('submissions.status', ['paid', 'processing', 'completed'])
        ->whereBetween('submissions.created_at', [$startDate, $endDate])
        ->groupBy('year', 'month')
        ->orderBy('year', 'ASC')
        ->orderBy('month', 'ASC')
        ->get();

        // Prepare data for graph (last 12 months)
        $graphData = [];
        $current = $startDate->copy();
        
        while ($current <= $endDate) {
            $year = $current->year;
            $month = $current->month;
            
            // Find revenue for this month
            $revenue = $monthlyRevenue->where('year', $year)->where('month', $month)->first();
            
            $graphData[] = [
                'label' => $current->format('M'), // Jan, Feb
                'year' => $year,
                'full_date' => $current->format('F Y'),
                'revenue' => $revenue ? (float)$revenue->revenue : 0
            ];
            
            $current->addMonth();
        }

        // Get current month revenue (last item in our graph data)
        $currentMonthData = end($graphData);
        $currentMonthRevenue = $currentMonthData ? $currentMonthData['revenue'] : 0;
        
        // Add to stats
        $stats['monthly_revenue'] = $currentMonthRevenue;
        $stats['revenue_graph_data'] = $graphData;

        return view('admin.dashboard', compact('stats'));
    }
}