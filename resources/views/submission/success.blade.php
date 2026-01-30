<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful - ValenGrading</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#15171A] text-white font-['Outfit'] antialiased">
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8 flex flex-col items-center justify-center">
        <div class="max-w-2xl w-full">
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-emerald-500/20 text-emerald-500 mb-6 border border-emerald-500/20 shadow-[0_0_30px_rgba(16,185,129,0.2)]">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <h1 class="text-4xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400 mb-2">Payment Confirmed!</h1>
                <p class="text-emerald-400 font-medium">Your submission #{{ $submission->submission_no }} has been successfully received.</p>
            </div>

            <div class="bg-[#232528]/80 backdrop-blur-xl border border-white/5 rounded-3xl p-8 shadow-2xl relative overflow-hidden group mb-8">
                <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/5 rounded-full blur-3xl -z-10 transition-all duration-700 group-hover:bg-emerald-500/10"></div>
                
                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    Order Summary
                </h3>

                <div class="space-y-4 mb-8">
                    <div class="flex justify-between items-center py-3 border-b border-white/5">
                        <span class="text-gray-400">Grading Service ({{ $submission->serviceLevel->name }})</span>
                        <span class="font-medium text-white">€{{ number_format($submission->serviceLevel->price_per_card, 2) }} x {{ $submission->card_entry_mode === 'detailed' ? $submission->cards->sum('qty') : $submission->total_cards }}</span>
                    </div>
                    
                    @if($submission->card_entry_mode === 'detailed')
                        @php $labelTotal = 0; foreach($submission->cards as $c) { $labelTotal += ($c->labelType->price_adjustment ?? 0) * ($c->qty ?? 1); } @endphp
                        @if($labelTotal > 0)
                            <div class="flex justify-between items-center py-3 border-b border-white/5">
                                <span class="text-gray-400">Label Adjustments</span>
                                <span class="font-medium text-white">€{{ number_format($labelTotal, 2) }}</span>
                            </div>
                        @endif
                    @endif

                    <div class="flex justify-between items-center pt-6">
                        <span class="text-lg font-bold text-white">Total Amount Paid</span>
                        <span class="text-2xl font-bold text-emerald-500">€{{ number_format($submission->total_cost, 2) }}</span>
                    </div>
                </div>

                <div class="bg-[#15171A] rounded-2xl p-6 border border-white/10 mb-8">
                    <h4 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">Submission Instructions</h4>
                    <ul class="space-y-3 text-sm text-gray-300">
                        <li class="flex gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-500/10 text-emerald-500 flex-shrink-0 flex items-center justify-center text-[10px] font-bold">1</span>
                            Please enclose this packing slip inside your securely packaged submission.
                        </li>
                        <li class="flex gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-500/10 text-emerald-500 flex-shrink-0 flex items-center justify-center text-[10px] font-bold">2</span>
                            If you do not have access to printer; handwrite details (Name, Sub #, Card Count) on a sheet.
                        </li>
                        <li class="flex gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-500/10 text-emerald-500 flex-shrink-0 flex items-center justify-center text-[10px] font-bold">3</span>
                            Clearly mark your Submission Number on the outside of the parcel.
                        </li>
                    </ul>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <button onclick="downloadSlip()" class="flex items-center justify-center gap-2 px-6 py-4 rounded-xl bg-white/10 text-white font-bold hover:bg-white/20 transition-all border border-white/10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Download Slip
                    </button>
                    <a href="{{ (auth()->check() && auth()->user()->role === 'admin') ? route('admin.dashboard') : route('user.dashboard') }}" class="flex items-center justify-center gap-2 px-6 py-4 rounded-xl bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold hover:scale-[1.02] transition-all shadow-[0_0_20px_rgba(163,5,10,0.3)]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        View Orders
                    </a>
                </div>

                <iframe id="slip-iframe" class="opacity-0 pointer-events-none absolute w-0 h-0 border-0" style="left: -9999px;"></iframe>

                <script>
                    function downloadSlip() {
                        const iframe = document.getElementById('slip-iframe');
                        iframe.src = "{{ route('submission.packingSlip.download', $submission->id) }}";
                    }
                </script>
            </div>
            
            <p class="text-center text-gray-500 text-sm italic">
                A confirmation email has been sent to {{ $submission->user->email ?? $submission->shippingAddress->email }}.
            </p>
        </div>
    </div>
</body>
</html>
