<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start Submission - ValenGrading</title>
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
                            {{ $index + 1 <= 1 ? 'bg-gradient-to-r from-red-500 to-[#A3050A] shadow-[0_0_15px_rgba(163,5,10,0.4)] scale-110' : 'bg-[#232528] text-gray-500' }}">
                            @if($index + 1 < 1)
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            @else
                                {{ $index + 1 }}
                            @endif
                        </div>
                        <span class="text-xs font-medium {{ $index + 1 <= 1 ? 'text-white' : 'text-gray-500' }}">{{ $step }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-[#232528]/80 backdrop-blur-xl rounded-2xl border border-white/5 p-8 shadow-2xl relative overflow-hidden group">
            <!-- Glassmorphism Background -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-red-500/10 rounded-full blur-3xl -z-10 transition-all duration-700 group-hover:bg-red-500/15"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-red-900/10 rounded-full blur-3xl -z-10 transition-all duration-700 group-hover:bg-red-900/15"></div>

            <div class="mb-8 text-center">
                <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-red-400 to-[#A3050A] mb-2">Start Your Submission</h2>
                <p class="text-gray-400">Let's get started with your submission details.</p>
            </div>

            <form action="{{ route('submission.storeStep1') }}" method="POST">
                @csrf
                
                <div class="mb-8">
                    <label for="submission_name" class="block mb-2 text-sm font-semibold text-gray-300">Submission Name</label>
                    <input type="text" id="submission_name" name="submission_name" 
                        value="{{ old('submission_name', session('submission_data.submission_name')) }}"
                        class="w-full bg-[#15171A] border border-white/10 text-white text-lg rounded-xl focus:ring-2 focus:ring-red-500/50 focus:border-red-500 block p-4 transition-all placeholder-gray-600" 
                        placeholder="e.g. My Pokemon Collection #1" required>
                    @error('submission_name')
                        <p class="mt-2 text-sm text-red-500 flex items-center"><span class="mr-1">⚠</span> {{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-10">
                    <label class="block mb-4 text-sm font-semibold text-gray-300 uppercase tracking-wider">Select Submission Type</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($types as $type)
                            <div class="relative">
                                <input type="radio" id="type_{{ $type->id }}" name="submission_type_id" value="{{ $type->id }}" class="peer hidden" 
                                    {{ (old('submission_type_id', session('submission_data.submission_type_id')) == $type->id) ? 'checked' : '' }} required>
                                <label for="type_{{ $type->id }}" class="block text-left p-5 bg-[#15171A] border border-white/10 rounded-xl cursor-pointer peer-checked:border-red-500 peer-checked:bg-red-500/5 transition-all hover:bg-white/5 shadow-md group">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="font-bold text-lg text-white group-hover:text-red-400 transition-colors">{{ $type->title }}</span>
                                        <div class="w-5 h-5 rounded-full border-2 border-gray-600 peer-checked:bg-red-500 peer-checked:border-red-500"></div>
                                    </div>
                                    <p class="text-sm text-gray-400">{{ $type->description ?? 'Standard service option.' }}</p>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('submission_type_id')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end pt-6 border-t border-white/10">
                    <button type="submit" class="w-full md:w-auto text-white bg-gradient-to-r from-red-600 to-[#A3050A] font-bold rounded-xl text-lg px-8 py-4 shadow-[0_0_20px_rgba(163,5,10,0.3)] hover:shadow-[0_0_30px_rgba(163,5,10,0.5)] transform transition hover:scale-[1.02]">
                        Continue to Service Level →
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
