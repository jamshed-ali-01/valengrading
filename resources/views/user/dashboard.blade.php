<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ValenGrading</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #0F1113; color: #fff; }
        .glass { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .red-glow { box-shadow: 0 0 50px rgba(163, 5, 10, 0.1); }
        .reveal-gradient { background: linear-gradient(135deg, #A3050A 0%, #E31E24 100%); }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="h-20 border-b border-white/5 flex items-center justify-between px-8 bg-[#0F1113]/80 backdrop-blur-xl sticky top-0 z-50">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 label-gradient rounded-xl flex items-center justify-center font-bold text-xl shadow-lg ring-1 ring-white/20">V</div>
                <h1 class="text-xl font-bold tracking-tight">Collector Center</h1>
            </div>
            
            <div class="flex items-center gap-6">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-white leading-none mb-1">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Collector</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="p-2 text-gray-500 hover:text-red-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </header>

        <main class="flex-1 p-8 max-w-7xl mx-auto w-full">
            <!-- stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="glass p-6 rounded-3xl red-glow">
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest block mb-1">Total Submissions</span>
                    <span class="text-3xl font-bold">{{ $stats['total_submissions'] }}</span>
                </div>
                <div class="glass p-6 rounded-3xl">
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest block mb-1">Total Cards</span>
                    <span class="text-3xl font-bold">{{ $stats['total_cards'] }}</span>
                </div>
                <div class="glass p-6 rounded-3xl border-red-500/20">
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest block mb-1">Active Orders</span>
                    <span class="text-3xl font-bold text-red-500">{{ $stats['active_orders'] }}</span>
                </div>
            </div>

            <!-- Submissions -->
            <div class="space-y-8">
                <h2 class="text-xl font-bold px-2">Your Submissions</h2>
                
                @forelse($submissions as $submission)
                <div x-data="{ open: false }" class="glass rounded-[2rem] overflow-hidden transition-all duration-300" :class="open ? 'ring-2 ring-red-500/20' : ''">
                    <!-- Order Header -->
                    <div class="p-8 flex flex-wrap items-center justify-between gap-6 cursor-pointer hover:bg-white/5 transition-colors" @click="open = !open">
                        <div class="flex items-center gap-6">
                            <div class="w-16 h-16 rounded-2xl bg-white/5 flex flex-col items-center justify-center border border-white/5">
                                <span class="text-xs font-bold text-gray-500 uppercase tracking-tighter">ORDER</span>
                                <span class="text-lg font-bold">#{{ $submission->submission_no }}</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white">{{ $submission->serviceLevel->name }}</h3>
                                <p class="text-xs text-gray-500 uppercase tracking-widest font-bold">{{ $submission->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-8">
                            <div class="text-center hidden sm:block">
                                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest block mb-1">Cards</span>
                                <span class="font-bold">{{ $submission->card_entry_mode === 'detailed' ? $submission->cards->sum('qty') : $submission->total_cards }}</span>
                            </div>
                            <div class="text-center hidden sm:block">
                                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest block mb-1">Total</span>
                                <span class="font-bold">€{{ number_format($submission->total_cost, 2) }}</span>
                            </div>
                            <div class="px-6 py-2 rounded-full text-xs font-bold uppercase tracking-wider bg-white/5 border border-white/10"
                                :class="{
                                    'text-emerald-500 bg-emerald-500/10 border-emerald-500/20': '{{ $submission->status }}' == 'paid' || '{{ $submission->status }}' == 'completed',
                                    'text-amber-500 bg-amber-500/10 border-amber-500/20': '{{ $submission->status }}' == 'shipped' || '{{ $submission->status }}' == 'at_grading'
                                }">
                                {{ str_replace('_', ' ', $submission->status) }}
                            </div>
                            <svg class="w-6 h-6 text-gray-600 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>

                    <!-- Cards Content -->
                    <div x-show="open" x-collapse>
                        <div class="p-8 pt-4 border-t border-white/5 bg-white/[0.02]">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @forelse($submission->cards as $card)
                                <div class="glass p-6 rounded-3xl relative group {{ $card->is_revealed ? 'red-glow ring-1 ring-red-500/20' : '' }}">
                                    <div class="mb-4">
                                        <div class="flex justify-between items-start mb-2">
                                            <span class="text-[10px] font-bold text-red-500 uppercase tracking-[0.2em]">{{ $card->status }}</span>
                                            @if($card->is_revealed)
                                                <div class="w-10 h-10 rounded-xl bg-red-600 flex items-center justify-center font-bold text-lg shadow-lg">
                                                    {{ explode(' ', $card->grade ?? '')[count(explode(' ', $card->grade ?? ''))-1] ?? '-' }}
                                                </div>
                                            @endif
                                        </div>
                                        <h4 class="font-bold text-white group-hover:text-red-500 transition-colors">{{ $card->title }}</h4>
                                        <p class="text-xs text-gray-500">{{ $card->year }} {{ $card->set_name }} #{{ $card->card_number }}</p>
                                    </div>

                                    @if($card->is_revealed)
                                        <div class="space-y-4">
                                            <div class="p-4 bg-black/40 rounded-2xl border border-white/5 space-y-2">
                                                <p class="font-bold text-sm text-gray-400 uppercase tracking-widest text-center">{{ $card->grade }}</p>
                                                <div class="grid grid-cols-2 gap-2">
                                                    <div class="text-center font-bold text-[10px] text-gray-600 uppercase">C: {{ $card->centering ?: '-' }}</div>
                                                    <div class="text-center font-bold text-[10px] text-gray-600 uppercase">K: {{ $card->corners ?: '-' }}</div>
                                                    <div class="text-center font-bold text-[10px] text-gray-600 uppercase">E: {{ $card->edges ?: '-' }}</div>
                                                    <div class="text-center font-bold text-[10px] text-gray-600 uppercase">S: {{ $card->surface ?: '-' }}</div>
                                                </div>
                                            </div>
                                            <a href="{{ route('card.report', $card->cert_number) }}" target="_blank" class="block w-full text-center py-3 bg-red-600 hover:bg-red-700 text-white text-xs font-bold uppercase tracking-widest rounded-xl transition-all shadow-lg ring-1 ring-white/20">
                                                View Grading Report
                                            </a>
                                        </div>
                                    @else
                                        <div class="mt-4 p-4 bg-white/5 rounded-2xl border border-dashed border-white/10 text-center">
                                            <svg class="w-6 h-6 mx-auto mb-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Result Locked</p>
                                            <p class="text-[8px] text-gray-600 mt-1 uppercase">Pending Quality Control Reveal</p>
                                        </div>
                                    @endif
                                </div>
                                @empty
                                    <div class="col-span-full py-12 text-center glass rounded-3xl border-dashed">
                                        <p class="text-gray-500 italic text-sm">Processing card data...</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="glass p-12 rounded-[2rem] text-center border-dashed">
                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 00-2 2H6a2 2 0 00-2 2v-5m16 0h-3.586a1 1 0 00-.707.293l-1.414 1.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-1.414-1.414A1 1 0 006.586 13H4"></path></svg>
                    <p class="text-gray-500 text-lg mb-6">No submissions found yet.</p>
                    <a href="{{ route('submission.step1') }}" class="inline-flex items-center gap-2 px-8 py-4 label-gradient rounded-2xl font-bold uppercase tracking-widest text-sm shadow-xl shadow-red-900/20 transition-transform hover:scale-105">
                        Start Your First Submission
                    </a>
                </div>
                @endforelse
            </div>
        </main>

        <!-- Footer Decorations -->
        <div class="fixed bottom-0 right-0 w-[500px] h-[500px] bg-red-600/5 rounded-full blur-[120px] -z-10"></div>
    </div>
</body>
</html>
