@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<div class="space-y-8">
    <!-- Stat Cards -->
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6">
        <!-- Total Users -->
        <div class="bg-[#232528]/50 backdrop-blur-xl border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500/10 rounded-full blur-2xl -z-10 transition-all duration-700 group-hover:bg-blue-500/20"></div>
            <div class="flex flex-col h-full justify-between gap-4">
                <div class="w-10 h-10 rounded-lg bg-blue-500/20 flex items-center justify-center text-blue-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div>
                    <h4 class="text-2xl font-bold text-white">{{ $stats['total_users'] }}</h4>
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Total Users</p>
                </div>
            </div>
        </div>

        <!-- Total Submissions -->
        <div class="bg-[#232528]/50 backdrop-blur-xl border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gray-500/10 rounded-full blur-2xl -z-10 transition-all duration-700 group-hover:bg-gray-500/20"></div>
            <div class="flex flex-col h-full justify-between gap-4">
                <div class="w-10 h-10 rounded-lg bg-gray-500/20 flex items-center justify-center text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <div>
                    <h4 class="text-2xl font-bold text-white">{{ $stats['total_submissions'] }}</h4>
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">All Submissions</p>
                </div>
            </div>
        </div>

        <!-- Received Submissions (Non-Draft) -->
        <div class="bg-[#232528]/50 backdrop-blur-xl border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-500/10 rounded-full blur-2xl -z-10 transition-all duration-700 group-hover:bg-emerald-500/20"></div>
            <div class="flex flex-col h-full justify-between gap-4">
                <div class="w-10 h-10 rounded-lg bg-emerald-500/20 flex items-center justify-center text-emerald-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h4 class="text-2xl font-bold text-white">{{ $stats['received_submissions'] }}</h4>
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Received Orders</p>
                </div>
            </div>
        </div>

        <!-- Drafts -->
        <div class="bg-[#232528]/50 backdrop-blur-xl border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-gray-500/10 rounded-full blur-2xl -z-10 transition-all duration-700 group-hover:bg-gray-500/20"></div>
            <div class="flex flex-col h-full justify-between gap-4">
                <div class="w-10 h-10 rounded-lg bg-gray-500/20 flex items-center justify-center text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
                <div>
                    <h4 class="text-2xl font-bold text-white">{{ $stats['draft_submissions'] }}</h4>
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Drafts</p>
                </div>
            </div>
        </div>

        <!-- Monthly Revenue -->
        <div class="bg-[#232528]/50 backdrop-blur-xl border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-500/10 rounded-full blur-2xl -z-10 transition-all duration-700 group-hover:bg-emerald-500/20"></div>
            <div class="flex flex-col h-full justify-between gap-4">
                <div class="w-10 h-10 rounded-lg bg-emerald-500/20 flex items-center justify-center text-emerald-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h4 class="text-2xl font-bold text-white">€{{ number_format($stats['monthly_revenue'], 2) }}</h4>
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Monthly Revenue</p>
                </div>
            </div>
        </div>

        <!-- Total Cards -->
        <div class="bg-[#232528]/50 backdrop-blur-xl border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-purple-500/10 rounded-full blur-2xl -z-10 transition-all duration-700 group-hover:bg-purple-500/20"></div>
            <div class="flex flex-col h-full justify-between gap-4">
                <div class="w-10 h-10 rounded-lg bg-purple-500/20 flex items-center justify-center text-purple-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <div>
                    <h4 class="text-2xl font-bold text-white">{{ $stats['total_cards'] }}</h4>
                    <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Total Cards</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Graph - Line Chart Only -->
    <div class="bg-[#232528]/80 backdrop-blur-xl border border-white/5 rounded-2xl p-6 shadow-xl relative "> <!-- Removed overflow-hidden from parent to allow tooltip overflow if needed -->
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                Revenue Trend (Last 12 Months)
            </h3>
            <div class="flex items-center gap-2">
                <div class="w-3 h-0.5 bg-emerald-400"></div>
                <span class="text-xs text-gray-400">Trend Line</span>
            </div>
        </div>
        
        @php
            $graphData = $stats['revenue_graph_data'] ?? [];
            
            // Check if we need demo data
            $hasData = false;
            foreach($graphData as $data) {
                if($data['revenue'] > 0) { $hasData = true; break; }
            }
            
            if(!$hasData && empty($graphData)) {
                 $endDate = now();
                 $startDate = now()->subMonths(11);
                 $current = $startDate->copy();
                 
                 while($current <= $endDate) {
                     $graphData[] = [
                        'label' => $current->format('M'),
                        'full_date' => $current->format('F Y'),
                        'revenue' => 0
                     ];
                     $current->addMonth();
                 }
            }
            
            $maxRevenue = 0;
            foreach($graphData as $d) {
                if($d['revenue'] > $maxRevenue) $maxRevenue = $d['revenue'];
            }
            
            $maxRevenue = $maxRevenue ?: 100; // Default max scale if all 0
            $maxScale = $maxRevenue * 1.2;
            $chartHeight = 200; 
            
            // Generate points using percentages for X axis to be fully responsive
            $linePoints = [];
            $totalPoints = count($graphData);
            
            foreach($graphData as $index => $data) {
                $revenue = $data['revenue'];
                $heightPercentage = ($revenue / $maxScale) * 100;
                
                // Y Position (pixels)
                $yPos = $chartHeight - (($heightPercentage / 100) * $chartHeight);
                
                // X Position (percentage)
                // First point at 2%, Last point at 98% to leave some padding
                if ($totalPoints > 1) {
                    $xPercent = 2 + ($index * (96 / ($totalPoints - 1)));
                } else {
                    $xPercent = 50;
                }
                
                $linePoints[] = [
                    'x_pct' => $xPercent, // Save percentage for SVG x coordinates
                    'y' => $yPos, 
                    'revenue' => $revenue,
                    'label' => $data['label'],
                    'full_date' => $data['full_date']
                ];
            }
            
            // SVG Path Construction using percentages
            $linePath = '';
            $areaPath = '';
            
            if(count($linePoints) > 0) {
                // Since SVG path 'd' attribute doesn't blindly accept %, we have to use a viewBox with a coordinate system.
                // We'll use a viewBox of 0 0 1000 $chartHeight. 
                // Then map x_pct (0-100) to x (0-1000).
                
                $viewBoxWidth = 1000;
                
                // Convert all points to the coordinate system
                $mappedPoints = array_map(function($p) use ($viewBoxWidth) {
                    $p['x'] = ($p['x_pct'] / 100) * $viewBoxWidth;
                    return $p;
                }, $linePoints);

                $linePath .= "M {$mappedPoints[0]['x']} {$mappedPoints[0]['y']} ";
                $areaPath .= "M {$mappedPoints[0]['x']} {$chartHeight} L {$mappedPoints[0]['x']} {$mappedPoints[0]['y']} ";
                
                foreach($mappedPoints as $index => $point) {
                    if($index === 0) continue;
                    
                    $prevPoint = $mappedPoints[$index - 1];
                    
                    // Cubic Bezier formatting
                    $controlX1 = $prevPoint['x'] + (($point['x'] - $prevPoint['x']) / 3);
                    $controlY1 = $prevPoint['y'];
                    $controlX2 = $point['x'] - (($point['x'] - $prevPoint['x']) / 3);
                    $controlY2 = $point['y'];
                    
                    $curve = "C {$controlX1} {$controlY1}, {$controlX2} {$controlY2}, {$point['x']} {$point['y']} ";
                    $linePath .= $curve;
                    $areaPath .= $curve;
                }
                
                $lastPoint = end($mappedPoints);
                $areaPath .= "L {$lastPoint['x']} {$chartHeight} Z";
            }
        @endphp
        
        <div class="relative h-64 mt-4 select-none">
            <!-- Y-axis Guidelines -->
            <div class="absolute left-0 top-0 bottom-6 w-12 flex flex-col justify-between text-xs text-gray-500 font-medium z-10">
                @for($i = 4; $i >= 0; $i--)
                    <span>€{{ number_format(($maxScale / 4) * $i, 0) }}</span>
                @endfor
            </div>
            
            <!-- Grid Lines -->
            <div class="absolute left-10 right-0 top-0 bottom-6 z-0 pointer-events-none flex flex-col justify-between">
                @for($i = 0; $i <= 4; $i++)
                    <div class="w-full border-t border-white/[0.03]"></div>
                @endfor
            </div>
            
            <!-- Chart Container -->
            <div class="absolute left-10 right-0 top-0 bottom-0 z-20">
                <!-- SVG Chart -->
                <svg width="100%" height="100%" viewBox="0 0 1000 {{ $chartHeight + 30 }}" preserveAspectRatio="none" class="overflow-visible">
                    <defs>
                        <linearGradient id="lineGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#34d399" />
                            <stop offset="100%" stop-color="#10b981" />
                        </linearGradient>
                        <linearGradient id="areaGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" stop-color="#10b981" stop-opacity="0.2" />
                            <stop offset="100%" stop-color="#10b981" stop-opacity="0" />
                        </linearGradient>
                        <filter id="glow" x="-20%" y="-20%" width="140%" height="140%">
                            <feGaussianBlur stdDeviation="2" result="coloredBlur"/>
                            <feMerge>
                                <feMergeNode in="coloredBlur"/>
                                <feMergeNode in="SourceGraphic"/>
                            </feMerge>
                        </filter>
                    </defs>
                    
                    <!-- Area under the line -->
                    <path d="{{ $areaPath }}" fill="url(#areaGradient)" />
                    
                    <!-- The Line -->
                    <path d="{{ $linePath }}" fill="none" stroke="url(#lineGradient)" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" filter="url(#glow)" />
                    
                    <!-- Interactive Data Points -->
                    @foreach($mappedPoints as $point)
                        <g class="group cursor-pointer chart-point" 
                           data-date="{{ $point['full_date'] }}" 
                           data-revenue="€{{ number_format($point['revenue']) }}"
                           data-cx="{{ $point['x'] / 10 }}" 
                           data-cy="{{ $point['y'] }}"
                           >
                            <!-- Large invisible trigger area -->
                            <circle cx="{{ $point['x'] }}" cy="{{ $point['y'] }}" r="15" fill="transparent" />
                            
                            <!-- Visible Point -->
                            <circle cx="{{ $point['x'] }}" cy="{{ $point['y'] }}" r="4" fill="#10b981" class="transition-all duration-300 group-hover:r-6 group-hover:fill-white group-hover:stroke-emerald-500 group-hover:stroke-2" />
                            
                            <!-- X Axis Label -->
                            <text x="{{ $point['x'] }}" y="{{ $chartHeight + 20 }}" text-anchor="middle" fill="#6b7280" font-size="12" font-weight="500">{{ $point['label'] }}</text>
                        </g>
                    @endforeach
                </svg>
                
                <!-- HTML Tooltip (Absolute positioned, hidden by default) -->
                <div id="chart-tooltip" class="absolute pointer-events-none opacity-0 transition-opacity duration-200 z-50 bg-[#1f2937] border border-gray-700 rounded-lg shadow-xl px-3 py-2 -translate-x-1/2 -translate-y-full mb-3" style="top: 0; left: 0;">
                    <div class="text-xs text-gray-400 font-medium mb-0.5" id="tooltip-date"></div>
                    <div class="text-sm text-white font-bold" id="tooltip-revenue"></div>
                    <!-- Arrow down -->
                    <div class="absolute left-1/2 -translate-x-1/2 bottom-[-6px] w-3 h-3 bg-[#1f2937] border-r border-b border-gray-700 rotate-45"></div>
                </div>
            </div>
        </div>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const points = document.querySelectorAll('.chart-point');
                const tooltip = document.getElementById('chart-tooltip');
                const dateEl = document.getElementById('tooltip-date');
                const revEl = document.getElementById('tooltip-revenue');
                const container = tooltip.parentElement; // The chart container div
                
                points.forEach(point => {
                    point.addEventListener('mouseenter', function() {
                        const date = this.getAttribute('data-date');
                        const revenue = this.getAttribute('data-revenue');
                        
                        // Percentage X coordinate (0-100)
                        const cxPercent = parseFloat(this.getAttribute('data-cx'));
                        // Exact Y coordinate (pixels)
                        const cy = parseFloat(this.getAttribute('data-cy'));
                        
                        dateEl.textContent = date;
                        revEl.textContent = revenue;
                        
                        // Position tooltip using percentage for Left, and pixels for Top
                        tooltip.style.left = cxPercent + '%';
                        tooltip.style.top = (cy - 10) + 'px'; // 10px offset up
                        tooltip.classList.remove('opacity-0');
                    });
                    
                    point.addEventListener('mouseleave', function() {
                        tooltip.classList.add('opacity-0');
                    });
                });
            });
        </script>
    </div>

    <!-- Recent Submissions Table -->
    <div class="bg-[#232528]/80 backdrop-blur-xl border border-white/5 rounded-2xl overflow-hidden shadow-2xl">
        <div class="p-6 border-b border-white/5 flex items-center justify-between">
            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Recent Activity
            </h3>
            <a href="{{ route('admin.submissions.index') }}" class="text-sm text-red-400 hover:text-red-300 transition-colors font-medium">View All Submissions →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-white/5 text-gray-400 uppercase text-[10px] font-bold tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Submission #</th>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Service</th>
                        <th class="px-6 py-4 text-center">Price</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($stats['recent_submissions'] as $submission)
                        <tr class="hover:bg-white/[0.02] transition-colors group">
                            <td class="px-6 py-4 font-medium text-white">{{ $submission->submission_no }}</td>
                            <td class="px-6 py-4">
                                <div class="text-white font-medium">{{ $submission->guest_name ?? $submission->user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $submission->user->email ?? 'Guest' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium text-gray-300">{{ $submission->serviceLevel->name }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-bold text-emerald-400">€{{ number_format($submission->total_cost, 2) }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $colors = [
                                        'draft' => 'bg-gray-500/20 text-gray-400',
                                        'pending_payment' => 'bg-amber-500/20 text-amber-400',
                                        'paid' => 'bg-emerald-500/20 text-emerald-400',
                                        'processing' => 'bg-red-500/20 text-red-400',
                                        'completed' => 'bg-purple-500/20 text-purple-400',
                                    ];
                                    $color = $colors[$submission->status] ?? 'bg-gray-500/20 text-gray-400';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $color }}">
                                    {{ str_replace('_', ' ', $submission->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.submissions.show', $submission) }}" class="btn-load p-2 rounded-lg bg-white/5 text-gray-400 hover:text-white hover:bg-white/10 transition-all inline-block">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500 italic">No submissions found yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($stats['recent_submissions']->hasPages())
            <div class="px-6 py-4 border-t border-white/5 font-medium">
                {{ $stats['recent_submissions']->appends(['recent_page' => request('recent_page')])->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
