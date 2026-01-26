@extends('layouts.admin')

@section('title', 'Submission Details: ' . $submission->submission_no)

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">
    <!-- Header with Status Update -->
    <div class="bg-[#232528]/80 backdrop-blur-xl border border-white/5 rounded-2xl p-6 shadow-2xl flex flex-wrap items-center justify-between gap-6">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-red-500/20 flex items-center justify-center text-red-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <div>
                <h3 class="text-xl font-bold text-white">{{ $submission->submission_no }}</h3>
                <p class="text-sm text-gray-500">Submitted on {{ $submission->created_at->format('M d, Y H:i') }}</p>
            </div>
        </div>

        <form action="{{ route('admin.submissions.update-status', $submission) }}" method="POST" class="flex items-center gap-3">
            @csrf
            @method('PATCH')
            <label class="text-sm font-medium text-gray-400">Update Status:</label>
            <select name="status" class="bg-[#15171A] border border-white/10 rounded-lg px-4 py-2 text-sm text-white focus:outline-none focus:border-red-500 transition-colors">
                @foreach(['draft', 'pending_payment', 'paid', 'processing', 'shipped', 'completed', 'cancelled'] as $status)
                    <option value="{{ $status }}" {{ $submission->status === $status ? 'selected' : '' }}>
                        {{ ucwords(str_replace('_', ' ', $status)) }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-[#A3050A] hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg transition-all text-sm shadow-lg shadow-red-900/20">Update</button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Customer Info -->
        <div class="bg-[#232528]/80 border border-white/5 rounded-2xl p-6 shadow-xl">
            <h4 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Customer Details
            </h4>
            <div class="space-y-4">
                <div>
                    <p class="text-xs text-gray-500">Name</p>
                    <p class="font-medium text-white">{{ $submission->guest_name ?? $submission->user->name }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Email</p>
                    <p class="font-medium text-white">{{ $submission->user->email ?? 'Guest' }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Service Level</p>
                    <p class="font-medium text-white">{{ $submission->serviceLevel->name }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Type</p>
                    <p class="font-medium text-white">{{ $submission->submissionType->name }}</p>
                </div>
            </div>
        </div>

        <!-- Shipping Address -->
        <div class="bg-[#232528]/80 border border-white/5 rounded-2xl p-6 shadow-xl md:col-span-2">
            <h4 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Shipping Address
            </h4>
            @if($submission->shippingAddress)
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-xs text-gray-500">Full Name</p>
                        <p class="text-white">{{ $submission->shippingAddress->full_name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Contact</p>
                        <p class="text-white">{{ $submission->shippingAddress->number }}</p>
                        <p class="text-white">{{ $submission->shippingAddress->email }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-xs text-gray-500">Address</p>
                        <p class="text-white leading-relaxed">
                            {{ $submission->shippingAddress->address_line_1 }}<br>
                            @if($submission->shippingAddress->address_line_2) {{ $submission->shippingAddress->address_line_2 }}<br> @endif
                            {{ $submission->shippingAddress->city }}, {{ $submission->shippingAddress->post_code }}<br>
                            {{ $submission->shippingAddress->country }}
                        </p>
                    </div>
                </div>
            @else
                <p class="text-gray-500 italic">No shipping address recorded.</p>
            @endif
        </div>
    </div>

    
    @if($submission->card_entry_mode === 'easy')
        @php
            $currentCount = $submission->cards->sum('qty');
            $totalCards = $submission->total_cards;
            $remaining = $totalCards - $currentCount;
            $progressPercent = $totalCards > 0 ? ($currentCount / $totalCards) * 100 : 0;
        @endphp

        <!-- Admin Card Entry (Easy Mode) -->
        <div class="bg-[#232528]/80 backdrop-blur-xl border border-white/5 rounded-2xl p-6 shadow-2xl">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Easy Mode Entry
                    </h3>
                    <p class="text-xs text-gray-500 mt-1">Manually enter received cards for this submission.</p>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold {{ $remaining == 0 ? 'text-emerald-500' : 'text-white' }}">{{ $currentCount }} <span class="text-sm text-gray-500 font-normal">/ {{ $totalCards }}</span></div>
                    <div class="text-xs text-gray-500 uppercase tracking-widest">Cards Entered</div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="w-full bg-white/5 rounded-full h-2 mb-8 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-500 to-emerald-400 h-2 rounded-full transition-all duration-500" style="width: {{ $progressPercent }}%"></div>
            </div>

            @if($remaining > 0)
            <form action="{{ route('admin.submissions.cards.store', $submission) }}" method="POST" class="bg-white/5 rounded-xl p-6 border border-white/5">
                @csrf
                <h4 class="text-sm font-bold text-gray-300 uppercase tracking-widest mb-4">Add New Card</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <!-- Hidden Qty forces 1 per entry -->
                    <input type="hidden" name="qty" value="1">
                    
                    <!-- Year -->
                    <div class="md:col-span-2">
                        <label class="block text-xs text-gray-500 uppercase font-bold mb-1">Year</label>
                        <input type="text" name="year" placeholder="2024" class="w-full bg-[#15171A] border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none">
                    </div>

                    <!-- Set Name -->
                    <div class="md:col-span-3">
                        <label class="block text-xs text-gray-500 uppercase font-bold mb-1">Set Name</label>
                        <input type="text" name="set_name" placeholder="Pokemon TCG" class="w-full bg-[#15171A] border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none">
                    </div>

                    <!-- Card Name/Title -->
                    <div class="md:col-span-5">
                        <label class="block text-xs text-gray-500 uppercase font-bold mb-1">Card Name / Title</label>
                        <input type="text" name="title" required placeholder="Charizard VMAX" class="w-full bg-[#15171A] border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none">
                    </div>
                    
                    <!-- Card Number -->
                    <div class="md:col-span-2">
                        <label class="block text-xs text-gray-500 uppercase font-bold mb-1">Card #</label>
                        <input type="text" name="card_number" placeholder="001/100" class="w-full bg-[#15171A] border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none">
                    </div>
                </div>
                
                <div class="mt-4 flex justify-end">
                     <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2 px-6 rounded-lg text-sm transition-all shadow-lg shadow-emerald-900/20 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Add Card
                    </button>
                </div>
            </form>
            @else
            <div class="bg-emerald-500/10 border border-emerald-500/20 rounded-xl p-4 flex items-center gap-3 text-emerald-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <p class="font-bold">All cards entered</p>
                    <p class="text-xs text-emerald-400/70">This submission has reached the paid card limit.</p>
                </div>
            </div>
            @endif
        </div>
    @endif

    <!-- Cards Itemized List -->
    <div class="bg-[#232528]/80 backdrop-blur-xl border border-white/5 rounded-2xl overflow-hidden shadow-2xl">
        <div class="p-6 border-b border-white/5">
            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Itemized Cards ({{ count($submission->cards) }})
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-white/5 text-gray-400 uppercase text-[10px] font-bold tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Card Info</th>
                        <th class="px-6 py-4 text-center">Label Type</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($submission->cards as $card)
                        <tr class="hover:bg-white/[0.02] transition-colors group">
                            <td class="px-6 py-4">
                                <div class="text-white font-medium">{{ $card->title }}</div>
                                <div class="text-xs text-gray-500">{{ $card->year }} {{ $card->set_name }} #{{ $card->card_number }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($card->labelType)
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-500/10 text-red-400 border border-red-500/20">
                                        {{ $card->labelType->name }}
                                    </span>
                                @else
                                    <span class="text-gray-600">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                    $statusColors = [
                                        'Submission Complete' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
                                        'Cards Received' => 'bg-blue-500/10 text-blue-500 border-blue-500/20',
                                        'In Grading' => 'bg-amber-500/10 text-amber-500 border-amber-500/20',
                                        'Slabbed' => 'bg-purple-500/10 text-purple-500 border-purple-500/20',
                                        'Delivered' => 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20',
                                    ];
                                    $colorClass = $statusColors[$card->status] ?? 'bg-white/5 text-gray-300 border-white/10';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold border uppercase tracking-tighter {{ $colorClass }}">
                                    {{ $card->status ?? 'Submission Complete' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.submissions.cards.edit', $card) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all text-[11px] font-bold">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    Edit Details
                                </a>
                            </td>
                        </tr>
                    @empty
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                @if($submission->card_entry_mode === 'easy')
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-12 h-12 rounded-full bg-amber-500/10 flex items-center justify-center text-amber-500">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="text-white font-bold text-lg">Easy Mode Submission</p>
                                            <p class="text-sm text-gray-500 max-w-xs mx-auto">This submission contains <strong>{{ $submission->total_cards }}</strong> cards, but itemized details were not provided by the user.</p>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-gray-500 italic">No cards found documented for this submission.</p>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.submissions.index') }}" class="px-6 py-3 rounded-xl bg-white/5 text-gray-300 hover:text-white hover:bg-white/10 transition-all font-medium border border-white/5">
            Back to List
        </a>
    </div>
</div>
@endsection
