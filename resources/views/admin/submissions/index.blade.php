@extends('layouts.admin')

@section('title', 'Manage Submissions')

@section('content')
<div class="space-y-6" x-data="submissionsTable">
    <div class="bg-[#232528]/80 backdrop-blur-xl border border-white/5 rounded-2xl overflow-hidden shadow-2xl">
        <div class="p-6 border-b border-white/5 flex items-center justify-between">
            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                All Submissions
            </h3>
            
            <div class="flex items-center gap-3">
                <!-- Status Filter -->
                <select x-model="status" class="bg-[#15171A] border border-white/10 rounded-lg px-3 py-1.5 text-xs text-gray-300 focus:outline-none focus:border-red-500 transition-all cursor-pointer">
                    <option value="">All Statuses</option>
                    @foreach(['draft', 'processing', 'shipped', 'completed', 'cancelled'] as $st)
                        <option value="{{ $st }}">{{ strtoupper(str_replace('_', ' ', $st)) }}</option>
                    @endforeach
                </select>

                <!-- Search Input -->
                <div class="relative">
                    <input type="text" x-model="search" placeholder="Search..." 
                        class="bg-[#15171A] border border-white/10 rounded-lg px-3 py-1.5 text-xs text-white focus:outline-none focus:border-red-500 transition-all w-48 pl-8">
                    <svg class="w-3.5 h-3.5 text-gray-500 absolute left-2.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-white/5 text-gray-400 uppercase text-[10px] font-bold tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Submission</th>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Service Details</th>
                        <th class="px-6 py-4 text-center">Summary</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($submissions as $submission)
                        <tr class="hover:bg-white/[0.02] transition-colors group"
                            x-ref="row_{{ $loop->index }}"
                            data-search="{{ strtolower($submission->submission_no . ' ' . ($submission->guest_name ?? '') . ' ' . ($submission->user->name ?? '') . ' ' . ($submission->user->email ?? '')) }}"
                            data-status="{{ $submission->status }}"
                            x-data
                            x-show="isVisible($el)"
                            style="display: none;">
                            <td class="px-6 py-4">
                                <div class="font-bold text-white tracking-wide">#{{ $submission->submission_no }}</div>
                                <div class="text-[10px] text-gray-500 uppercase font-medium mt-0.5">{{ $submission->created_at->format('M d, Y') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-white font-medium">{{ $submission->guest_name ?? $submission->user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $submission->user->email ?? 'Guest' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-300 font-medium">{{ $submission->serviceLevel->name }}</div>
                                <div class="text-[10px] text-gray-500 uppercase">{{ $submission->submissionType?->name }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="text-sm font-bold text-emerald-400">€{{ number_format($submission->total_cost, 2) }}</div>
                                <div class="text-[10px] text-gray-500 font-bold uppercase mt-0.5">{{ $submission->total_cards }} Cards</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $colors = [
                                        'draft' => 'bg-gray-500/20 text-gray-400',
                                        // 'pending_payment' => 'bg-amber-500/20 text-amber-400',
                                        'order_received' => 'bg-emerald-500/20 text-emerald-400',
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
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if($submission->status !== 'draft')
                                        <a href="{{ route('submission.packingSlip.download', $submission) }}" class="p-2 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-all" title="Download Packing Slip">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 00-2 2h2m2 4h10a2 2 0 002-2v-4a2 2 0 012-2H5a2 2 0 01-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.submissions.show', $submission) }}" class="p-2 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-all font-bold" title="View Details">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.submissions.destroy', $submission) }}" method="POST" onsubmit="return confirm('Delete this submission permanently?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-all" title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500 italic">No submissions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-white/5 bg-white/[0.02] flex items-center justify-between">
            <div class="text-xs text-gray-500">
                Showing <span x-text="(currentPage - 1) * pageSize + 1"></span> to <span x-text="Math.min(currentPage * pageSize, filteredCount)"></span> of <span x-text="filteredCount"></span> entries
            </div>
            
            <div class="flex items-center gap-2" x-show="filteredCount > pageSize">
                <button @click="currentPage--" :disabled="currentPage === 1" 
                    class="p-2 rounded-lg border border-white/10 text-gray-400 hover:text-white hover:border-white/30 disabled:opacity-50 disabled:cursor-not-allowed transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                
                <span class="text-xs text-gray-400 font-mono bg-white/5 px-3 py-1.5 rounded-lg border border-white/10">
                    Page <span x-text="currentPage"></span>
                </span>

                <button @click="currentPage++" :disabled="currentPage * pageSize >= filteredCount"
                    class="p-2 rounded-lg border border-white/10 text-gray-400 hover:text-white hover:border-white/30 disabled:opacity-50 disabled:cursor-not-allowed transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('submissionsTable', () => ({
            search: '',
            status: '',
            currentPage: 1,
            pageSize: 15,
            allRows: [],

            init() {
                // Capture all rows on init
                this.allRows = Array.from(this.$el.querySelectorAll('tbody tr'));
                
                // Reset page on filter change
                this.$watch('search', () => { this.currentPage = 1; });
                this.$watch('status', () => { this.currentPage = 1; });
            },

            get filteredRows() {
                if (!this.search && !this.status) return this.allRows;
                
                const searchLower = this.search.toLowerCase();
                
                return this.allRows.filter(row => {
                    const searchData = row.dataset.search;
                    const statusData = row.dataset.status;
                    
                    const matchesSearch = this.search === '' || searchData.includes(searchLower);
                    const matchesStatus = this.status === '' || this.status === statusData;
                    
                    return matchesSearch && matchesStatus;
                });
            },

            get filteredCount() {
                return this.filteredRows.length;
            },

            get paginatedRows() {
                const start = (this.currentPage - 1) * this.pageSize;
                const end = start + this.pageSize;
                return this.filteredRows.slice(start, end);
            },

            isVisible(el) {
                return this.paginatedRows.includes(el);
            }
        }));
    });
</script>
@endsection
