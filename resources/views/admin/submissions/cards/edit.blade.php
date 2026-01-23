@extends('layouts.admin')

@section('title', 'Edit Card: ' . $card->title)

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.submissions.show', $card->submission_id) }}" class="text-gray-400 hover:text-white flex items-center gap-2 transition-colors group">
            <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span class="font-medium">Back to Submission Details</span>
        </a>
        <div class="flex items-center gap-3">
            <span class="text-xs text-gray-500 uppercase tracking-widest font-bold">Submission No:</span>
            <span class="text-red-500 font-bold bg-red-500/10 px-3 py-1 rounded-lg border border-red-500/20">{{ $card->submission->submission_no }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Context Card -->
        <div class="space-y-6">
            <div class="bg-[#232528]/80 backdrop-blur-xl border border-white/5 rounded-2xl p-6 shadow-2xl">
                <h4 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-6 flex items-center gap-2">
                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Card Context
                </h4>
                
                <div class="space-y-5">
                    <div class="p-4 bg-[#15171A] rounded-xl border border-white/5 space-y-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Title</label>
                            <p class="text-white font-bold text-lg leading-tight">{{ $card->title }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Year</label>
                                <p class="text-white">{{ $card->year ?: '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Set</label>
                                <p class="text-white truncate" title="{{ $card->set_name }}">{{ $card->set_name ?: '-' }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Number</label>
                                <p class="text-white">#{{ $card->card_number ?: '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Language</label>
                                <p class="text-white">{{ strtoupper($card->lang ?? '-') }}</p>
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-1">Label Type</label>
                            <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-500/10 text-red-400 border border-red-500/20">
                                {{ $card->labelType->name ?? 'Standard' }}
                            </span>
                        </div>
                    </div>

                    @if($card->notes)
                        <div class="p-4 bg-white/5 rounded-xl border border-white/5">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Customer Notes</label>
                            <p class="text-sm text-gray-300 italic">"{{ $card->notes }}"</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column: Update Form -->
        <div class="lg:col-span-2">
            <div class="bg-[#232528]/80 backdrop-blur-xl border border-white/5 rounded-2xl shadow-2xl overflow-hidden h-full">
                <div class="p-8 border-b border-white/5 bg-white/5">
                    <h3 class="text-xl font-bold text-white">Update Card Information</h3>
                    <p class="text-gray-400 text-sm mt-1">Manage the lifecycle and internal tracking of this card.</p>
                </div>

                <form action="{{ route('admin.submissions.cards.update', $card) }}" method="POST" class="p-8 space-y-8">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="status" class="block text-sm font-bold text-gray-300 uppercase tracking-wider mb-3">Status</label>
                        <div class="relative">
                            <select name="status" id="status" class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-colors appearance-none cursor-pointer">
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" {{ ($card->status ?? 'Submission Complete') === $status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        @error('status')
                            <p class="mt-2 text-xs text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="admin_notes" class="block text-sm font-bold text-gray-300 uppercase tracking-wider mb-3">Admin Notes (Internal Tracker)</label>
                        <textarea name="admin_notes" id="admin_notes" rows="6" 
                            class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-colors resize-none placeholder-gray-600"
                            placeholder="Add internal tracking notes, grading feedback, or processing details...">{{ old('admin_notes', $card->admin_notes) }}</textarea>
                        @error('admin_notes')
                            <p class="mt-2 text-xs text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 flex items-center gap-4">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold py-4 rounded-xl transition-all shadow-xl shadow-red-900/20 uppercase tracking-widest text-sm hover:scale-[1.02] active:scale-95">
                            Update Details
                        </button>
                        <a href="{{ route('admin.submissions.show', $card->submission_id) }}" class="px-8 py-4 bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white rounded-xl transition-colors font-bold uppercase tracking-widest text-sm border border-white/5">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
