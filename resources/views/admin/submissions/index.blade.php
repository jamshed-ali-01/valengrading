@extends('layouts.admin')

@section('title', 'Manage Submissions')

@section('content')
<div class="space-y-6">
    <div class="bg-[#232528]/80 backdrop-blur-xl border border-white/5 rounded-2xl overflow-hidden shadow-2xl">
        <div class="p-6 border-b border-white/5 flex items-center justify-between">
            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                All Submissions
            </h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-white/5 text-gray-400 uppercase text-[10px] font-bold tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Submission #</th>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Service & Type</th>
                        <th class="px-6 py-4 text-center">Cards</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($submissions as $submission)
                        <tr class="hover:bg-white/[0.02] transition-colors group">
                            <td class="px-6 py-4 font-medium text-white">{{ $submission->submission_no }}</td>
                            <td class="px-6 py-4">
                                <div class="text-white font-medium">{{ $submission->guest_name ?? $submission->user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $submission->user->email ?? 'Guest' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-300 font-medium">{{ $submission->serviceLevel->name }}</div>
                                <div class="text-[10px] text-gray-500 uppercase">{{ $submission->submissionType?->name }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-sm font-bold text-red-400 bg-red-500/10 px-2.5 py-1 rounded-lg">
                                    {{ $submission->total_cards }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $colors = [
                                        'draft' => 'bg-gray-500/20 text-gray-400',
                                        'pending_payment' => 'bg-amber-500/20 text-amber-400',
                                        'paid' => 'bg-emerald-500/20 text-emerald-400',
                                        'processing' => 'bg-red-500/20 text-red-400',
                                        'shipped' => 'bg-red-700/20 text-red-500',
                                        'completed' => 'bg-red-600/20 text-red-400',
                                        'cancelled' => 'bg-red-900/20 text-red-700',
                                    ];
                                    $color = $colors[$submission->status] ?? 'bg-gray-500/20 text-gray-400';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $color }}">
                                    {{ str_replace('_', ' ', $submission->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 tabular-nums">
                                {{ $submission->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('admin.submissions.show', $submission) }}" class="p-2 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-all" title="View Details">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.submissions.destroy', $submission) }}" method="POST" onsubmit="return confirm('Delete this submission permanently?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-all" title="Delete">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500 italic">No submissions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-white/5 bg-white/[0.02]">
            {{ $submissions->links() }}
        </div>
    </div>
</div>
@endsection
