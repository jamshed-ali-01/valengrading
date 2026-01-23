<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - ValenGrading</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="min-h-screen bg-[#15171A] text-white font-['Outfit'] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <!-- Progress Steps -->
        <div class="mb-12">
            <div class="flex items-center justify-between relative">
                <div class="absolute left-0 top-1/2 w-full h-1 bg-white/5 -z-10 rounded-full"></div>
                
                @foreach(['Submission Type', 'Service Level', 'Card Details', 'Shipping', 'Review', 'Payment'] as $index => $step)
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm mb-2 transition-all duration-300 relative
                            {{ $index + 1 <= 6 ? 'bg-gradient-to-r from-red-500 to-[#A3050A] shadow-[0_0_15px_rgba(163,5,10,0.4)] scale-110' : 'bg-[#232528] text-gray-500' }}">
                            @if($index + 1 < 6)
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            @else
                                {{ $index + 1 }}
                            @endif
                        </div>
                        <span class="text-xs font-medium {{ $index + 1 <= 6 ? 'text-white' : 'text-gray-500' }}">{{ $step }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-[#232528]/80 backdrop-blur-xl rounded-2xl border border-white/5 p-8 shadow-2xl relative overflow-hidden group">
            <!-- Glassmorphism Background -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-red-500/10 rounded-full blur-3xl -z-10 transition-all duration-700 group-hover:bg-red-500/15"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-red-900/10 rounded-full blur-3xl -z-10 transition-all duration-700 group-hover:bg-red-900/15"></div>

            <div class="mb-8 text-center">
                <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-red-400 to-[#A3050A] mb-2">Complete Payment</h2>
                <p class="text-gray-400">You will be redirected to Stripe's secure payment page.</p>
            </div>
            
            @php
                // Calculate total again for display
                $totalCost = 0;
                if ($submission->card_entry_mode === 'detailed') {
                    foreach($submission->cards as $card) {
                        $labelCost = $card->labelType?->price_adjustment ?? 0;
                        $totalCost += ($submission->serviceLevel->price_per_card + $labelCost) * ($card->qty ?? 1);
                    }
                } else {
                    $labelCost = $submission->labelType?->price_adjustment ?? 0;
                    $totalCost = ($submission->serviceLevel->price_per_card + $labelCost) * $submission->total_cards;
                }
            @endphp

            <div class="bg-[#15171A] rounded-xl p-6 border border-white/10 mb-8 flex justify-between items-center">
                <div>
                     <p class="text-sm text-gray-400">Total Amount</p>
                     <p class="text-3xl font-bold text-red-500">€{{ number_format($totalCost, 2) }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-400">Submission #</p>
                    <p class="text-lg font-medium text-white">{{ $submission->submission_no }}</p>
                </div>
            </div>

            @if(session('error'))
                <div class="text-red-500 text-sm mb-4 text-center bg-red-500/10 border border-red-500/20 rounded-lg p-3">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('submission.processPayment') }}" method="POST" id="payment-form">
                @csrf
                
                <div class="flex items-center gap-3 mb-8 p-4 bg-red-500/10 border border-red-500/20 rounded-lg">
                    <svg class="w-6 h-6 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    <p class="text-sm text-red-400">Upon clicking, you'll be taken to Stripe's official checkout page to finish your payment.</p>
                </div>

                <div class="flex justify-between items-center pt-6 border-t border-white/10">
                    <a href="{{ route('submission.step5') }}" class="px-6 py-3 rounded-xl bg-white/5 text-gray-300 hover:text-white hover:bg-white/10 transition-all duration-300 font-medium border border-white/5">
                        Back to Review
                    </a>
                    
                    <button type="submit" id="submit-button" class="group relative px-8 py-3 rounded-xl bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold shadow-[0_0_20px_rgba(163,5,10,0.3)] hover:shadow-[0_0_30px_rgba(163,5,10,0.5)] transition-all duration-300 hover:scale-[1.02]">
                        <span class="relative z-10 flex items-center gap-2" id="button-text">
                            Pay with Stripe
                            <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </span>
                        <div class="absolute inset-0 rounded-xl bg-white/10 blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('payment-form').addEventListener('submit', function(e) {
        var submitButton = document.getElementById('submit-button');
        submitButton.disabled = true;
        document.getElementById('button-text').innerText = 'Redirecting...';
    });
</script>
</body>
</html>
