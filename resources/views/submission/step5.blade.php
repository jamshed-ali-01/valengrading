@extends('layouts.frontend')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
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
                <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-red-400 to-[#A3050A] mb-2">Review Your Submission</h2>
                <p class="text-gray-400">Please review your details before proceeding to payment.</p>
            </div>

            <!-- Submission Info -->
            <div class="space-y-6 mb-8">
                <div class="bg-[#15171A] p-6 rounded-xl border border-white/10">
                    <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"></path></svg>
                        Submission Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-500">Submission Name</p>
                            <p class="text-white font-medium">{{ $submission->guest_name ?? $submission->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Submission Type</p>
                            <p class="text-white font-medium">{{ $submission->submissionType->name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Service Level</p>
                            <p class="text-white font-medium">{{ $submission->serviceLevel->name }} (€{{ number_format($submission->serviceLevel->price_per_card, 2) }}/card)</p>
                        </div>
                        <div>
                            <p class="text-gray-500">Total Cards</p>
                            <p class="text-white font-medium">
                                @if($submission->card_entry_mode === 'detailed')
                                    {{ $submission->cards->sum('qty') }}
                                @else
                                    {{ $submission->total_cards }}
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-500">Entry Mode</p>
                            <p class="text-white font-medium capitalize">{{ $submission->card_entry_mode }}</p>
                        </div>
                    </div>
                </div>

                <!-- Shipping Info -->
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
                        @php 
                            $shippingRate = (float) \App\Models\SiteSetting::get('return_shipping_fee', 7.99); 
                            $cardCount = ($submission->card_entry_mode === 'detailed') ? $submission->cards->sum('qty') : $submission->total_cards;
                            
                            $basePrice = $submission->serviceLevel->price_per_card;
                            $totalBaseCost = $basePrice * $cardCount;
                            
                            // Calculate total label cost separately for the summary
                            $totalLabelCost = 0;
                            if ($submission->card_entry_mode === 'detailed') {
                                foreach($submission->cards as $card) {
                                    $totalLabelCost += ($card->labelType?->price_adjustment ?? 0) * ($card->qty ?? 1);
                                }
                            } else {
                                $totalLabelCost = ($submission->labelType?->price_adjustment ?? 0) * $cardCount;
                            }
                        @endphp
                        <tr>
                            <td colspan="2" class="px-6 py-3 text-right text-gray-400">
                                Card Grading Fee ({{ $cardCount }} x €{{ number_format($basePrice, 2) }}):
                            </td>
                            <td class="px-6 py-3 text-right font-medium text-white">€{{ number_format($totalBaseCost, 2) }}</td>
                        </tr>
                        @if($totalLabelCost != 0)
                        <tr>
                            <td colspan="2" class="px-6 py-3 text-right text-gray-400">
                                Label Upgrades:
                            </td>
                            <td class="px-6 py-3 text-right font-medium text-white">
                                @if($submission->card_entry_mode === 'easy')
                                    <span class="text-xs text-gray-500 mr-2">{{ $cardCount }} x €{{ number_format($submission->labelType->price_adjustment, 2) }}</span>
                                @endif
                                €{{ number_format($totalLabelCost, 2) }}
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <td colspan="2" class="px-6 py-3 text-right text-gray-400">Return Shipping (Flat Rate):</td>
                            <td class="px-6 py-3 text-right font-medium text-white">€{{ number_format($shippingRate, 2) }}</td>
                        </tr>
                        <tr class="border-t border-white/10">
                            <td colspan="2" class="px-6 py-4 text-right font-bold text-white uppercase tracking-wider">Grand Total:</td>
                            <td class="px-6 py-4 text-right font-bold text-red-500 text-xl tracking-tight">€{{ number_format($totalBaseCost + $totalLabelCost + $shippingRate, 2) }}</td>
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
