<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Population Report | Valen Grading</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #08090A; color: #E2E8F0; }
        .valen-border { border: 1px solid rgba(255, 255, 255, 0.05); }
    </style>
</head>
<body class="antialiased selection:bg-red-500/30">
    <div class="min-h-screen pb-20">
        <!-- Minimal Navigation -->
        <nav class="max-w-7xl mx-auto px-6 py-10 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <a href="/" class="flex items-center gap-3 hover:opacity-80 transition-opacity">
                    <div class="w-8 h-8 rounded-lg bg-red-600 flex items-center justify-center shadow-[0_0_20px_rgba(220,38,38,0.3)]">
                        <span class="text-white font-black text-xl">V</span>
                    </div>
                    <span class="font-bold uppercase tracking-[0.4em] text-xs text-white/80">Valen <span class="text-red-600">Grading</span></span>
                </a>
            </div>
            <div class="flex items-center gap-6">
                <form action="{{ route('pop-report.index') }}" method="GET" class="hidden md:flex items-center bg-white/5 border border-white/10 rounded-full px-4 py-2 focus-within:border-red-500/50 focus-within:bg-white/10 transition-all">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Cards..." class="bg-transparent border-none text-xs text-white placeholder-gray-500 focus:ring-0 w-48 font-medium ml-2">
                </form>
            </div>
        </nav>

        <main class="max-w-[1400px] mx-auto px-6">
            <div class="mb-12 text-center md:text-left">
                <h1 class="text-3xl font-extrabold text-white tracking-tight mb-2">Population Report</h1>
                <p class="text-gray-400 text-sm max-w-2xl">Verified census of all cards graded by Valen Grading.</p>
            </div>

            <!-- Table Container -->
            <div class="w-full bg-[#111214] border border-white/5 rounded-2xl overflow-hidden shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-black/40 text-gray-400 uppercase text-[10px] font-bold tracking-wider border-b border-white/5">
                            <tr>
                                <th class="px-6 py-5 whitespace-nowrap">Year</th>
                                <th class="px-6 py-5 whitespace-nowrap">Card Name</th>
                                <th class="px-6 py-5 whitespace-nowrap">Brand</th>
                                <th class="px-6 py-5 whitespace-nowrap">Set</th>
                                <th class="px-6 py-5 whitespace-nowrap">Card No</th>
                                <th class="px-6 py-5 whitespace-nowrap">Rarity</th>
                                @for($i = 1; $i <= 10; $i++)
                                    <th class="px-3 py-5 text-center w-12">{{ $i }}</th>
                                @endfor
                                <th class="px-6 py-5 text-center whitespace-nowrap border-l border-white/5">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($reports as $report)
                                <tr class="hover:bg-white/[0.02] transition-colors group">
                                    <td class="px-6 py-4 text-sm font-medium text-white whitespace-nowrap">{{ $report->year ?: '-' }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-white max-w-xs truncate" title="{{ $report->title }}">
                                        {{ $report->title }}
                                    </td>
                                    <td class="px-6 py-4 text-xs text-gray-400 whitespace-nowrap">{{ $report->brand ?: '-' }}</td>
                                    <td class="px-6 py-4 text-xs text-gray-400 whitespace-nowrap max-w-[150px] truncate" title="{{ $report->set_name }}">{{ $report->set_name ?: '-' }}</td>
                                    <td class="px-6 py-4 text-xs font-mono text-gray-400 whitespace-nowrap">{{ $report->card_number ?: '-' }}</td>
                                    <td class="px-6 py-4 text-xs text-gray-400 whitespace-nowrap">{{ $report->rarity ?: '-' }}</td>
                                    
                                    @for($i = 1; $i <= 10; $i++)
                                        <td class="px-3 py-4 text-center">
                                            @php $count = $report->{'grade_'.$i}; @endphp
                                            <span class="text-xs font-bold {{ $count > 0 ? 'text-white' : 'text-gray-700' }}">
                                                {{ $count }}
                                            </span>
                                        </td>
                                    @endfor

                                    <td class="px-6 py-4 text-center border-l border-white/5">
                                        <span class="text-emerald-500 font-bold text-sm">{{ $report->total_graded }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="17" class="px-6 py-20 text-center text-gray-500">
                                        <div class="flex flex-col items-center gap-3">
                                            <svg class="w-10 h-10 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                            <p class="font-medium">No graded cards found matching your criteria.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8">
                {{ $reports->links() }}
            </div>
        </main>

        <footer class="mt-20 border-t border-white/5 pt-12 text-center pb-8">
            <p class="text-[10px] text-gray-600 font-bold uppercase tracking-[0.2em] mb-4">Valen Grading Population Report</p>
            <p class="text-[9px] text-gray-800">Data is updated in real-time as cards are graded and verified.</p>
        </footer>
    </div>
</body>
</html>
