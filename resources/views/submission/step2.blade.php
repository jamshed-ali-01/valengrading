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
                            {{ $index + 1 <= 2 ? 'bg-gradient-to-r from-red-500 to-[#A3050A] shadow-[0_0_15px_rgba(163,5,10,0.4)] scale-110' : 'bg-[#232528] text-gray-500' }}">
                            @if($index + 1 < 2)
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            @else
                                {{ $index + 1 }}
                            @endif
                        </div>
                        <span class="text-xs font-medium {{ $index + 1 <= 2 ? 'text-white' : 'text-gray-500' }}">{{ $step }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-[#232528]/80 backdrop-blur-xl rounded-2xl border border-white/5 p-8 shadow-2xl relative overflow-hidden group">
            <!-- Glassmorphism Background -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-red-500/10 rounded-full blur-3xl -z-10 transition-all duration-700 group-hover:bg-red-500/15"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-red-900/10 rounded-full blur-3xl -z-10 transition-all duration-700 group-hover:bg-red-900/15"></div>

            <div class="mb-8 text-center">
                <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-red-400 to-[#A3050A] mb-2">Select Service Level</h2>
                <p class="text-gray-400">Choose a service level that fits your timeline and budget.</p>
            </div>

            <form action="{{ route('submission.storeStep2') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 gap-6 mb-8">
                    @foreach($levels as $level)
                    <div class="relative transform transition hover:-translate-y-1">
                        <input type="radio" id="level_{{ $level->id }}" name="service_level_id" value="{{ $level->id }}" class="peer hidden"
                            {{ (old('service_level_id', session('submission_data.service_level_id')) == $level->id) ? 'checked' : '' }} required>
                        
                        <label for="level_{{ $level->id }}" class="block p-6 bg-[#15171A] border border-white/10 rounded-xl cursor-pointer peer-checked:border-red-500 peer-checked:ring-1 peer-checked:ring-red-500/50 hover:bg-white/5 transition-all shadow-md group/card">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-xl font-bold text-white group-hover/card:text-red-400 transition-colors">{{ $level->name }}</h3>
                                    <p class="text-sm text-gray-400 mt-1 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $level->delivery_time }}
                                    </p>
                                    @if($level->min_submission)
                                        <p class="text-xs text-orange-400 mt-2 font-semibold flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                            Minimum {{ $level->min_submission }} Cards
                                        </p>
                                    @else
                                        <p class="text-xs text-green-400 mt-2 font-semibold flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            No Minimum
                                        </p>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <span class="text-3xl font-bold text-white">€{{ floatval($level->price_per_card) }}</span>
                                    <span class="block text-xs text-gray-500 uppercase tracking-wide">Per Card</span>
                                </div>
                            </div>
                        </label>
                    </div>
                    @endforeach
                </div>
                
                @error('service_level_id')
                    <p class="mb-6 text-sm text-red-500 text-center">{{ $message }}</p>
                @enderror

                <div class="flex justify-between items-center pt-6 border-t border-white/10">
                    <a href="{{ route('submission.step1') }}" class="px-6 py-3 rounded-xl bg-white/5 text-gray-300 hover:text-white hover:bg-white/10 transition-all duration-300 font-medium border border-white/5">
                        Back
                    </a>
                    
                    <button type="submit" class="group relative px-8 py-3 rounded-xl bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold shadow-[0_0_20px_rgba(163,5,10,0.3)] hover:shadow-[0_0_30px_rgba(163,5,10,0.5)] transition-all duration-300 hover:scale-[1.02]">
                        <span class="relative z-10 flex items-center gap-2">
                            Continue to Cards
                            <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </span>
                        <div class="absolute inset-0 rounded-xl bg-white/10 blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
