<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Review - ValenGrading</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="min-h-screen bg-[#15171A] text-white font-['Outfit'] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Progress Steps -->
        <div class="mb-12">
            <div class="flex items-center justify-between relative">
                <div class="absolute left-0 top-1/2 w-full h-1 bg-white/5 -z-10 rounded-full"></div>
                
                @foreach(['Submission Type', 'Service Level', 'Card Details', 'Shipping', 'Review', 'Payment'] as $index => $step)
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm mb-2 transition-all duration-300 relative
                            {{ $index + 1 <= 5 ? 'bg-gradient-to-r from-red-500 to-[#A3050A] shadow-[0_0_15px_rgba(163,5,10,0.4)] scale-110' : 'bg-[#232528] text-gray-500' }}">
                            @if($index + 1 < 5)
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            @else
                                {{ $index + 1 }}
                            @endif
                        </div>
                        <span class="text-xs font-medium {{ $index + 1 <= 5 ? 'text-white' : 'text-gray-500' }}">{{ $step }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-[#232528]/80 backdrop-blur-xl rounded-2xl border border-white/5 p-8 shadow-2xl relative overflow-hidden group">
            <!-- Glassmorphism Background -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-red-500/10 rounded-full blur-3xl -z-10 transition-all duration-700 group-hover:bg-red-500/15"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-red-900/10 rounded-full blur-3xl -z-10 transition-all duration-700 group-hover:bg-red-900/15"></div>

            <div class="mb-8">
                <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-red-400 to-[#A3050A] mb-2">Order Review</h2>
                <p class="text-gray-400">Please review your submission details before proceeding to payment.</p>
            </div>

            <!-- Submission Summary -->
            <div class="flex flex-col gap-6 mb-8">
                <!-- Submission Info -->
                <div class="bg-[#15171A] rounded-xl p-8 border border-white/10 w-full shadow-xl">
                    <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Submission Details
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-12">
                        <div class="flex justify-between items-center border-b border-white/5 pb-2">
                            <span class="text-gray-400">Submission No:</span>
                            <span class="font-bold text-red-500 tracking-wider">{{ $submission->submission_no }}</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-white/5 pb-2">
                            <span class="text-gray-400">Submission Name:</span>
                            <span class="font-medium text-white">{{ $submission->guest_name ?? $submission->user->name }}</span>
                        </div>
                         <div class="flex justify-between items-center border-b border-white/5 pb-2">
                            <span class="text-gray-400">Submission Type:</span>
                            <span class="font-medium text-white">{{ $submission->submissionType->name }}</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-white/5 pb-2">
                            <span class="text-gray-400">Service Level:</span>
                            <span class="font-medium text-white">{{ $submission->serviceLevel->name }} (€{{ number_format($submission->serviceLevel->price_per_card, 2) }}/card)</span>
                        </div>
                        <div class="flex justify-between items-center border-b border-white/5 pb-2">
                            <span class="text-gray-400">Total Cards:</span>
                            <span class="font-bold text-white text-lg">
                                @if($submission->card_entry_mode === 'detailed')
                                    {{ $submission->cards->sum('qty') }}
                                @else
                                    {{ $submission->total_cards }}
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Shipping Info -->
                <div class="bg-[#15171A] rounded-xl p-8 border border-white/10 w-full shadow-xl">
                    <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                        </svg>
                        Shipping Address
                    </h3>
                     @if($submission->shippingAddress)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <p class="text-xs text-gray-500 uppercase tracking-widest font-bold">Recipient</p>
                            <p class="font-bold text-xl text-white">{{ $submission->shippingAddress->full_name }}</p>
                            <div class="space-y-1 text-gray-300">
                                <p>{{ $submission->shippingAddress->address_line_1 }}</p>
                                @if($submission->shippingAddress->address_line_2)
                                    <p>{{ $submission->shippingAddress->address_line_2 }}</p>
                                @endif
                                <p>{{ $submission->shippingAddress->city }}, {{ $submission->shippingAddress->post_code }}</p>
                                <p class="text-white font-medium">{{ $submission->shippingAddress->country }}</p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <p class="text-xs text-gray-500 uppercase tracking-widest font-bold">Contact Details</p>
                            <div class="space-y-3">
                                <p class="flex items-center gap-3 text-white">
                                    <span class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </span>
                                    {{ $submission->shippingAddress->email }}
                                </p>
                                 <p class="flex items-center gap-3 text-white">
                                    <span class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </span>
                                    {{ $submission->shippingAddress->number }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @else
                        <div class="p-4 bg-red-500/10 border border-red-500/20 rounded-xl">
                            <p class="text-red-500 font-medium">Shipping information is missing. Please go back and complete the shipping step.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Cards Table -->
            <div class="mb-8 overflow-hidden rounded-xl border border-white/10">
                <table class="w-full text-left text-sm text-gray-400">
                    <thead class="bg-white/5 text-white uppercase font-medium">
                        <tr>
                            <th class="px-6 py-4">Card Details</th>
                            <th class="px-6 py-4 text-center">Label Type</th>
                            <th class="px-6 py-4 text-right">Cost</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 bg-[#15171A]">
                        @php $totalCost = 0; @endphp
                        @if ($submission->card_entry_mode === 'detailed')
                            @foreach($submission->cards as $card)
                                @php
                                    $labelCost = $card->labelType?->price_adjustment ?? 0;
                                    $cardCost = ($submission->serviceLevel->price_per_card + $labelCost) * ($card->qty ?? 1);
                                    $totalCost += $cardCost;
                                @endphp
                                <tr class="hover:bg-white/5 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-white">{{ $card->title }}</div>
                                        <div class="text-xs text-gray-400">{{ $card->set_name }} {{ $card->year ? '('.$card->year.')' : '' }} #{{ $card->card_number }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($card->labelType)
                                            <div class="flex flex-col items-center">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100/10 text-red-400 border border-red-500/20">
                                                    {{ $card->labelType->name }} 
                                                </span>
                                                @if($card->labelType->price_adjustment != 0)
                                                    <span class="text-[10px] text-gray-500 mt-1">
                                                        {{ $card->labelType->price_adjustment > 0 ? '+' : '' }}€{{ number_format($card->labelType->price_adjustment, 2) }}
                                                    </span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-gray-600">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="text-white font-medium">€{{ number_format($cardCost, 2) }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                             @php
                                $labelCost = $submission->labelType?->price_adjustment ?? 0;
                                $totalCost = ($submission->serviceLevel->price_per_card + $labelCost) * $submission->total_cards;
                             @endphp
                             <tr class="hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-white">{{ $submission->total_cards }} Cards (Easy Submission)</div>
                                </td>
                                 <td class="px-6 py-4 text-center">
                                    @if($submission->labelType)
                                        <div class="flex flex-col items-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100/10 text-red-400 border border-red-500/20">
                                                {{ $submission->labelType->name }} 
                                            </span>
                                            @if($submission->labelType->price_adjustment != 0)
                                                <span class="text-[10px] text-gray-500 mt-1">
                                                    {{ $submission->labelType->price_adjustment > 0 ? '+' : '' }}€{{ number_format($submission->labelType->price_adjustment, 2) }}
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-gray-600">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="text-white font-medium">€{{ number_format($totalCost, 2) }}</div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                    <tfoot class="bg-white/5">
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-right font-bold text-white">Total Amount:</td>
                            <td class="px-6 py-4 text-right font-bold text-red-500 text-lg">€{{ number_format($totalCost, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="flex justify-between items-center pt-6 border-t border-white/10">
                <a href="{{ route('submission.step4') }}" class="px-6 py-3 rounded-xl bg-white/5 text-gray-300 hover:text-white hover:bg-white/10 transition-all duration-300 font-medium border border-white/5">
                    Back to Shipping
                </a>
                
                <form action="{{ route('submission.processPayment') }}" method="POST">
                    @csrf
                    <button type="submit" class="group relative px-8 py-3 rounded-xl bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold shadow-[0_0_20px_rgba(163,5,10,0.3)] hover:shadow-[0_0_30px_rgba(163,5,10,0.5)] transition-all duration-300 hover:scale-[1.02]">
                        <span class="relative z-10 flex items-center gap-2">
                            Proceed to Payment
                            <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a1 1 0 11-2 0 1 1 0 012 0z"></path>
                            </svg>
                        </span>
                        <div class="absolute inset-0 rounded-xl bg-white/10 blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
