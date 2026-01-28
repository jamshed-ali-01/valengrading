@extends('layouts.frontend')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
<div class="min-h-screen bg-[#15171A] text-white font-['Outfit'] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <!-- Progress Steps -->
        <div class="mb-12">
            <div class="flex items-center justify-between relative">
                <div class="absolute left-0 top-1/2 w-full h-1 bg-white/5 -z-10 rounded-full"></div>
                
                @foreach(['Submission Type', 'Service Level', 'Card Details', 'Shipping', 'Review', 'Payment'] as $index => $step)
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm mb-2 transition-all duration-300 relative
                            {{ $index + 1 <= 4 ? 'bg-gradient-to-r from-red-500 to-[#A3050A] shadow-[0_0_15px_rgba(163,5,10,0.4)] scale-110' : 'bg-[#232528] text-gray-500' }}">
                            @if($index + 1 < 4)
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            @else
                                {{ $index + 1 }}
                            @endif
                        </div>
                        <span class="text-xs font-medium {{ $index + 1 <= 4 ? 'text-white' : 'text-gray-500' }}">{{ $step }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-[#232528]/80 backdrop-blur-xl rounded-2xl border border-white/5 p-8 shadow-2xl relative overflow-hidden group">
            <!-- Glassmorphism Background -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-red-500/10 rounded-full blur-3xl -z-10 transition-all duration-700 group-hover:bg-red-500/15"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-red-900/10 rounded-full blur-3xl -z-10 transition-all duration-700 group-hover:bg-red-900/15"></div>

            <div class="mb-8">
                <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-red-400 to-[#A3050A] mb-2">Shipping Information</h2>
                <p class="text-gray-400">Please enter your shipping details below.</p>
            </div>

            <form action="{{ route('submission.storeStep4') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Full Name -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="full_name" class="block text-sm font-medium text-gray-300 mb-1">Full Name</label>
                        <input type="text" name="full_name" id="full_name" required value="{{ old('full_name', $shippingAddress->full_name ?? '') }}" 
                            class="w-full bg-[#15171A] border border-white/10 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:border-red-500 transition-all placeholder-gray-600">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                        <input type="email" name="email" id="email" required value="{{ old('email', $shippingAddress->email ?? Auth::user()->email ?? '') }}" 
                            class="w-full bg-[#15171A] border border-white/10 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:border-red-500 transition-all placeholder-gray-600">
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="number" class="block text-sm font-medium text-gray-300 mb-1">Phone Number</label>
                        <input type="text" name="number" id="number" required value="{{ old('number', $shippingAddress->number ?? '') }}" 
                            class="w-full bg-[#15171A] border border-white/10 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:border-red-500 transition-all placeholder-gray-600">
                    </div>

                    <!-- Address Line 1 -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="address_line_1" class="block text-sm font-medium text-gray-300 mb-1">Address Line 1</label>
                        <input type="text" name="address_line_1" id="address_line_1" required value="{{ old('address_line_1', $shippingAddress->address_line_1 ?? '') }}" 
                            class="w-full bg-[#15171A] border border-white/10 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:border-red-500 transition-all placeholder-gray-600">
                    </div>

                    <!-- Address Line 2 -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="address_line_2" class="block text-sm font-medium text-gray-300 mb-1">Address Line 2 (Optional)</label>
                        <input type="text" name="address_line_2" id="address_line_2" value="{{ old('address_line_2', $shippingAddress->address_line_2 ?? '') }}" 
                            class="w-full bg-[#15171A] border border-white/10 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:border-red-500 transition-all placeholder-gray-600">
                    </div>

                    <!-- City -->
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-300 mb-1">City</label>
                        <input type="text" name="city" id="city" required value="{{ old('city', $shippingAddress->city ?? '') }}" 
                            class="w-full bg-[#15171A] border border-white/10 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:border-red-500 transition-all placeholder-gray-600">
                    </div>

                    <!-- County -->
                    <div>
                        <label for="county" class="block text-sm font-medium text-gray-300 mb-1">County (Optional)</label>
                        <input type="text" name="county" id="county" value="{{ old('county', $shippingAddress->county ?? '') }}" 
                            class="w-full bg-[#15171A] border border-white/10 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:border-red-500 transition-all placeholder-gray-600">
                    </div>

                    <!-- Post Code -->
                    <div>
                        <label for="post_code" class="block text-sm font-medium text-gray-300 mb-1">Post Code</label>
                        <input type="text" name="post_code" id="post_code" required value="{{ old('post_code', $shippingAddress->post_code ?? '') }}" 
                            class="w-full bg-[#15171A] border border-white/10 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:border-red-500 transition-all placeholder-gray-600">
                    </div>

                    <!-- Country -->
                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-300 mb-1">Country</label>
                        <input type="text" name="country" id="country" required value="{{ old('country', $shippingAddress->country ?? '') }}" 
                            class="w-full bg-[#15171A] border border-white/10 rounded-lg px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:border-red-500 transition-all placeholder-gray-600">
                    </div>
                </div>

                <div class="flex justify-between items-center pt-6 border-t border-white/10">
                    <a href="{{ route('submission.step3') }}" class="px-6 py-3 rounded-xl bg-white/5 text-gray-300 hover:text-white hover:bg-white/10 transition-all duration-300 font-medium border border-white/5">
                        Back to Cards
                    </a>
                    
                    <button type="submit" class="group relative px-8 py-3 rounded-xl bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold shadow-[0_0_20px_rgba(163,5,10,0.3)] hover:shadow-[0_0_30px_rgba(163,5,10,0.5)] transition-all duration-300 hover:scale-[1.02]">
                        <span class="relative z-10 flex items-center gap-2">
                            Proceed to Review
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
