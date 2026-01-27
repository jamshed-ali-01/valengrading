@extends('layouts.admin')

@section('title', 'Edit Population Report')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.population.index') }}" class="text-gray-400 hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-white">Edit Population Report</h1>
            <p class="text-gray-400 text-sm mt-1">Update population report entry</p>
        </div>
    </div>

    <div class="bg-[#232528] border border-white/5 rounded-2xl p-8">
        <form action="{{ route('admin.population.update', $populationReport) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="year" class="block text-sm font-bold text-gray-300 uppercase tracking-wider mb-2">Year</label>
                    <input type="text" name="year" id="year" value="{{ old('year', $populationReport->year) }}" class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all hover:border-white/20" placeholder="e.g. 2000">
                    @error('year')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="brand" class="block text-sm font-bold text-gray-300 uppercase tracking-wider mb-2">Brand</label>
                    <input type="text" name="brand" id="brand" value="{{ old('brand', $populationReport->brand) }}" class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all hover:border-white/20" placeholder="e.g. Pokemon, Topps">
                    @error('brand')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="title" class="block text-sm font-bold text-gray-300 uppercase tracking-wider mb-2">Card Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $populationReport->title) }}" required class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all hover:border-white/20" placeholder="e.g. Charizard">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="set_name" class="block text-sm font-bold text-gray-300 uppercase tracking-wider mb-2">Set Name</label>
                    <input type="text" name="set_name" id="set_name" value="{{ old('set_name', $populationReport->set_name) }}" class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all hover:border-white/20" placeholder="e.g. Base Set">
                    @error('set_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="card_number" class="block text-sm font-bold text-gray-300 uppercase tracking-wider mb-2">Card Number</label>
                    <input type="text" name="card_number" id="card_number" value="{{ old('card_number', $populationReport->card_number) }}" class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all hover:border-white/20" placeholder="e.g. 4/102">
                    @error('card_number')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="rarity" class="block text-sm font-bold text-gray-300 uppercase tracking-wider mb-2">Rarity</label>
                <input type="text" name="rarity" id="rarity" value="{{ old('rarity', $populationReport->rarity) }}" class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all hover:border-white/20" placeholder="e.g. Holo Rare">
                @error('rarity')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Grade Fields -->
            <div class="border-t border-white/10 pt-6">
                <h3 class="text-lg font-bold text-white mb-4">Grade Population</h3>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                    @for($i = 1; $i <= 10; $i++)
                        <div>
                            <label for="grade_{{ $i }}" class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Grade {{ $i }}</label>
                            <input type="number" name="grade_{{ $i }}" id="grade_{{ $i }}" value="{{ old('grade_'.$i, $populationReport->{'grade_'.$i}) }}" min="0" required class="w-full bg-[#15171A] border border-white/10 rounded-lg px-4 py-3 text-white text-center focus:outline-none focus:border-red-500 transition-all hover:border-white/20">
                            @error('grade_'.$i)
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endfor
                </div>
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold py-4 rounded-xl transition-all shadow-lg shadow-red-900/40 uppercase tracking-wider text-sm hover:scale-[1.02] active:scale-[0.98]">
                    Update Entry
                </button>
                <a href="{{ route('admin.population.index') }}" class="px-8 py-4 bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white rounded-xl transition-all font-bold uppercase tracking-wider text-sm border border-white/5">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
