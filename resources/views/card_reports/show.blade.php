<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certification #{{ $card->cert_number }} | Valen Grading</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #08090A; color: #E2E8F0; }
        .text-gradient { background: linear-gradient(135deg, #fff 0%, #94a3b8 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .valen-border { border: 1px solid rgba(255, 255, 255, 0.05); }
        .valen-card { background: rgba(15, 17, 19, 0.4); backdrop-filter: blur(20px); }
        .grade-pill { background: linear-gradient(135deg, #A3050A 0%, #7A0408 100%); }
        .sep-line { height: 1px; background: linear-gradient(to right, transparent, rgba(255,255,255,0.05), transparent); }
    </style>
</head>
<body class="antialiased selection:bg-red-500/30">
    <div class="min-h-screen pb-20">
        <!-- Minimal Navigation -->
        <nav class="max-w-6xl mx-auto px-6 py-10 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-red-600 flex items-center justify-center shadow-[0_0_20px_rgba(220,38,38,0.3)]">
                    <span class="text-white font-black text-xl">V</span>
                </div>
                <span class="font-bold uppercase tracking-[0.4em] text-xs text-white/80">Valen <span class="text-red-600">Grading</span></span>
            </div>
            <div class="flex items-center gap-6">
                <div class="hidden md:block text-right">
                    <p class="text-[9px] font-bold text-gray-500 uppercase tracking-widest leading-none mb-1">Certification ID</p>
                    <span class="text-white font-medium text-sm">#{{ $card->cert_number }}</span>
                </div>
                <div class="h-10 w-[1px] bg-white/5 hidden md:block"></div>
                <div class="px-4 py-2 rounded-full border border-emerald-500/20 bg-emerald-500/5 flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></div>
                    <span class="text-emerald-500 font-bold text-[10px] uppercase tracking-widest">Verified Database</span>
                </div>
            </div>
        </nav>

        <main class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
                
                <!-- Left: Master Visual -->
                <div class="lg:col-span-5 space-y-10">
                    <div class="relative">
                        <!-- Card Display -->
                        <div class="relative aspect-[3/4.2] rounded-[2.5rem] overflow-hidden valen-border shadow-2xl group">
                            <img id="main-image" src="{{ asset('storage/' . $card->grading_image) }}" alt="Card Front" class="w-full h-full object-contain transition-all duration-1000">
                            
                            <!-- Floating Grade Badge -->
                            <div class="absolute top-8 right-8 w-24 h-24 rounded-3xl bg-black/40 backdrop-blur-xl border border-white/10 flex flex-col items-center justify-center shadow-2xl">
                                <span class="text-[9px] font-bold text-gray-500 uppercase tracking-widest mb-1">Valen</span>
                                <span class="text-4xl font-black text-white leading-none">{{ explode(' ', $card->grade ?? '')[count(explode(' ', $card->grade ?? ''))-1] ?? '-' }}</span>
                            </div>
                        </div>

                        <!-- Image Swapper (Discrete) -->
                        <div class="flex justify-center gap-3 mt-8">
                            <button onclick="changeImage('{{ asset('storage/' . $card->grading_image) }}', this)" class="w-16 h-20 rounded-xl valen-border overflow-hidden transition-all duration-300 ring-2 ring-red-600">
                                <img src="{{ asset('storage/' . $card->grading_image) }}" class="w-full h-full object-cover">
                            </button>
                            <button onclick="changeImage('{{ asset('storage/' . $card->back_image) }}', this)" class="w-16 h-20 rounded-xl valen-border overflow-hidden transition-all duration-300 ring-2 ring-transparent hover:ring-white/20">
                                <img src="{{ asset('storage/' . $card->back_image) }}" class="w-full h-full object-cover opacity-50">
                            </button>
                        </div>
                    </div>

                    <!-- Bottom Branding -->
                    <div class="pt-8 text-center opacity-30">
                        <span class="text-[9px] font-bold uppercase tracking-[0.6em]">Premium Grading Standards</span>
                    </div>
                </div>

                <!-- Right: Analysis Dashboard -->
                <div class="lg:col-span-7 space-y-12">
                    
                    <!-- Identification Section -->
                    <section class="space-y-2">
                        <h2 class="text-red-500 font-bold uppercase tracking-[0.3em] text-[10px]">Registry Identification</h2>
                        <h1 class="text-5xl font-extrabold tracking-tight text-white leading-tight">
                            {{ $card->title }}
                        </h1>
                        <p class="text-xl text-gray-400 font-medium tracking-wide">
                            {{ $card->year }} {{ $card->set_name }} {{ $card->card_number }}
                        </p>
                    </section>

                    <div class="sep-line"></div>

                    <!-- Grading Dashboard -->
                    <section class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <!-- Final Grade -->
                        <div class="space-y-6">
                            <h3 class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Grading Conclusion</h3>
                            <div class="flex items-end gap-4">
                                <span class="text-6xl font-black text-white leading-none tracking-tighter">{{ $card->grade ?: 'PENDING' }}</span>
                                <span class="px-3 py-1 rounded-md bg-white/5 border border-white/10 text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">Authentic</span>
                            </div>
                        </div>

                        <!-- Sub-Analysis -->
                        <div class="space-y-6">
                            <h3 class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Sub-Analysis</h3>
                            <div class="grid grid-cols-2 gap-x-8 gap-y-4">
                                @foreach(['Centering', 'Corners', 'Edges', 'Surface'] as $sub)
                                <div class="flex justify-between items-center">
                                    <span class="text-[11px] font-medium text-gray-500 uppercase tracking-wider">{{ $sub }}</span>
                                    <span class="font-bold text-white text-lg">{{ $card->{strtolower($sub)} ?: '-' }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    <div class="sep-line"></div>

                    <!-- Detailed Specifications -->
                    <section class="space-y-6">
                        <h3 class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Technical Specifications</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-y-8 gap-x-12">
                            <div>
                                <p class="text-[9px] font-bold text-gray-600 uppercase tracking-widest mb-1.5">Language</p>
                                <p class="text-sm font-semibold text-white uppercase">{{ $card->lang ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-bold text-gray-600 uppercase tracking-widest mb-1.5">Label Type</p>
                                <p class="text-sm font-semibold text-red-500">{{ $card->labelType->name ?? 'Standard' }}</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-bold text-gray-600 uppercase tracking-widest mb-1.5">Reg. Date</p>
                                <p class="text-sm font-semibold text-white">{{ $card->updated_at->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-bold text-gray-600 uppercase tracking-widest mb-1.5">Total Population</p>
                                <p class="text-sm font-semibold text-white">1 (Registry Exclusive)</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-bold text-gray-600 uppercase tracking-widest mb-1.5">Pop. at Grade</p>
                                <p class="text-sm font-semibold text-white">1</p>
                            </div>
                        </div>
                    </section>

                    <!-- Professional Assessment -->
                    @if($card->grading_insights)
                    <section class="p-8 rounded-[2rem] bg-gradient-to-br from-white/[0.03] to-transparent valen-border relative group">
                        <div class="flex items-start gap-4">
                            <div class="mt-1 text-red-600">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            </div>
                            <div class="space-y-4">
                                <h3 class="text-[9px] font-bold text-red-500 uppercase tracking-widest">Lead Grader's Assessment</h3>
                                <p class="text-gray-400 italic font-medium leading-relaxed text-sm">
                                    "{{ $card->grading_insights }}"
                                </p>
                            </div>
                        </div>
                    </section>
                    @endif
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="mt-32 border-t border-white/5 pt-16">
            <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="space-y-4">
                    <p class="text-[10px] text-gray-500 font-medium uppercase tracking-[0.2em]">Secure Verification Portal</p>
                    <p class="text-xs text-gray-600 max-w-sm leading-relaxed">
                        This digital record is protected by Valen Grading's secure registry. Re-distribution or modification of this report is strictly prohibited.
                    </p>
                </div>
                <div class="flex flex-wrap gap-x-12 gap-y-6 md:justify-end">
                    <a href="{{ route('cert.index') }}" class="text-[10px] font-bold text-gray-400 hover:text-white transition-colors uppercase tracking-[0.3em] flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        New Search
                    </a>
                    <a href="/" class="text-[10px] font-bold text-gray-400 hover:text-white transition-colors uppercase tracking-[0.3em]">Official Website</a>
                    <a href="/login" class="text-[10px] font-bold text-gray-400 hover:text-white transition-colors uppercase tracking-[0.3em]">Submit Cards</a>
                </div>
            </div>
            <div class="mt-16 text-center">
                <p class="text-[8px] text-gray-700 font-bold uppercase tracking-[0.8em]">© {{ date('Y') }} Valen Certification Standards</p>
            </div>
        </footer>
    </div>

    <script>
        function changeImage(url, btn) {
            const main = document.getElementById('main-image');
            
            // UI Feedback
            document.querySelectorAll('button[onclick*="changeImage"]').forEach(b => {
                b.classList.remove('ring-red-600');
                b.classList.add('ring-transparent');
                b.querySelector('img').classList.add('opacity-50');
            });
            btn.classList.add('ring-red-600');
            btn.classList.remove('ring-transparent');
            btn.querySelector('img').classList.remove('opacity-50');

            // Transition
            main.style.opacity = '0';
            setTimeout(() => {
                main.src = url;
                main.style.opacity = '1';
            }, 400);
        }
    </script>
</body>
</html>
