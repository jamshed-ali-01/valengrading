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
    public function index(Request $request)
    {
        // Basic stats
        $stats = [
            'total_users' => User::count(),
            'total_submissions' => Submission::count(),
            'received_submissions' => Submission::where('status', '!=', 'draft')->count(),
            'draft_submissions' => Submission::where('status', 'draft')->count(),
            'pending_payments' => Submission::where('status', 'pending_payment')->count(),
            'paid_submissions' => Submission::where('status', 'order_received')->orWhere('status', 'processing')->orWhere('status', 'completed')->count(),
            'recent_submissions' => Submission::with(['user', 'serviceLevel', 'cards', 'labelType'])
                ->latest()
                ->paginate(10, ['*'], 'recent_page'),
            'total_cards' => Submission::whereIn('status', ['order_received', 'processing', 'completed'])
                ->sum('total_cards'),
        ];

        $filter = $request->input('revenue_filter', '12_months');
        $graphData = [];

        if ($filter === '30_days') {
            // Calculate daily revenue for last 30 days
            $endDate = Carbon::now()->endOfDay();
            $startDate = Carbon::now()->subDays(29)->startOfDay();

            $dailyRevenue = Submission::select(
                DB::raw('DATE(submissions.created_at) as date'),
                DB::raw('SUM(total_cards * service_levels.price_per_card) as revenue')
            )
            ->join('service_levels', 'submissions.service_level_id', '=', 'service_levels.id')
            ->whereIn('submissions.status', ['order_received', 'processing', 'completed'])
            ->whereBetween('submissions.created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

            $current = $startDate->copy();
            while ($current <= $endDate) {
                $dateStr = $current->format('Y-m-d');
                $revenue = $dailyRevenue->where('date', $dateStr)->first();

                $graphData[] = [
                    'label' => $current->format('d M'), // 28 Jan
                    'full_date' => $current->format('F j, Y'),
                    'revenue' => $revenue ? (float)$revenue->revenue : 0
                ];
                $current->addDay();
            }

            // Current revenue is just the last one
            $currentRevenue = end($graphData)['revenue'] ?? 0;
            
        } else {
            // Default: Calculate monthly revenue for last 12 months
            $endDate = Carbon::now()->endOfMonth();
            $startDate = Carbon::now()->subMonths(11)->startOfMonth();

            $monthlyRevenue = Submission::select(
                DB::raw('YEAR(submissions.created_at) as year'),
                DB::raw('MONTH(submissions.created_at) as month'),
                DB::raw('SUM(total_cards * service_levels.price_per_card) as revenue')
            )
            ->join('service_levels', 'submissions.service_level_id', '=', 'service_levels.id')
            ->whereIn('submissions.status', ['order_received', 'processing', 'completed'])
            ->whereBetween('submissions.created_at', [$startDate, $endDate])
            ->groupBy('year', 'month')
            ->orderBy('year', 'ASC')
            ->orderBy('month', 'ASC')
            ->get();

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

            // Get current month revenue
            $currentMonthData = end($graphData);
            $currentRevenue = $currentMonthData ? $currentMonthData['revenue'] : 0;
        }
        
        // Add to stats
        $stats['monthly_revenue'] = $currentRevenue;
        $stats['revenue_graph_data'] = $graphData;
        $stats['active_filter'] = $filter;

        return view('admin.dashboard', compact('stats'));
    }

    public function notifications()
    {
        $notifications = auth()->user()->notifications()->paginate(20);
        return view('admin.notifications.index', compact('notifications'));
    }

    public function markAllRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back()->with('success', 'All notifications marked as read.');
    }
}