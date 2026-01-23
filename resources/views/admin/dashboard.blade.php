@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<div class="space-y-8">
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-[#232528]/50 backdrop-blur-xl border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-red-500/10 rounded-full blur-3xl -z-10 transition-all duration-700 group-hover:bg-red-500/20"></div>
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-red-500/20 flex items-center justify-center text-red-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-400 font-medium">Total Submissions</p>
                    <h4 class="text-2xl font-bold text-white">{{ $stats['total_submissions'] }}</h4>
                </div>
            </div>
        </div>

        <div class="bg-[#232528]/50 backdrop-blur-xl border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-amber-500/10 rounded-full blur-3xl -z-10 transition-all duration-700 group-hover:bg-amber-500/20"></div>
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-500/20 flex items-center justify-center text-amber-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-400 font-medium">Pending Payments</p>
                    <h4 class="text-2xl font-bold text-white">{{ $stats['pending_payments'] }}</h4>
                </div>
            </div>
        </div>

        <div class="bg-[#232528]/50 backdrop-blur-xl border border-white/5 p-6 rounded-2xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 rounded-full blur-3xl -z-10 transition-all duration-700 group-hover:bg-emerald-500/20"></div>
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/20 flex items-center justify-center text-emerald-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-400 font-medium">Paid Orders</p>
                    <h4 class="text-2xl font-bold text-white">{{ $stats['paid_submissions'] }}</h4>
                </div>
            </div>
        </div>
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
                        <th class="px-6 py-4">Status</th>
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
                            <td class="px-6 py-4">
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
                                <a href="{{ route('admin.submissions.show', $submission) }}" class="p-2 rounded-lg bg-white/5 text-gray-400 hover:text-white hover:bg-white/10 transition-all inline-block">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500 italic">No submissions found yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
