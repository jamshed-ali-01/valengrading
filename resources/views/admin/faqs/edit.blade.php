@extends('layouts.admin')

@section('title', 'Edit FAQ')

@section('content')
<div class="w-full">
    <div class="bg-[#232528]/80 backdrop-blur-xl border border-white/5 rounded-2xl p-8 shadow-2xl">
        <form method="POST" action="{{ route('admin.faqs.update', $faq) }}" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-2">
                <label for="category" class="text-sm font-medium text-gray-400">Category*</label>
                <input type="text" id="category" name="category" value="{{ old('category', $faq->category) }}" 
                    class="w-full bg-[#15171A] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 transition-colors"
                    placeholder="e.g., Shipping, General" required>
                @error('category')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="space-y-2">
                <label for="question" class="text-sm font-medium text-gray-400">Question*</label>
                <input type="text" id="question" name="question" value="{{ old('question', $faq->question) }}" 
                    class="w-full bg-[#15171A] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 transition-colors"
                    placeholder="Enter the question" required>
                @error('question')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="space-y-2">
                <label for="answer" class="text-sm font-medium text-gray-400">Answer*</label>
                <textarea id="answer" name="answer" rows="4" 
                    class="w-full bg-[#15171A] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 transition-colors"
                    placeholder="Enter the answer" required>{{ old('answer', $faq->answer) }}</textarea>
                @error('answer')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="order" class="text-sm font-medium text-gray-400">Sort Order*</label>
                    <input type="number" id="order" name="order" value="{{ old('order', $faq->order) }}" 
                        class="w-full bg-[#15171A] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 transition-colors"
                        required>
                    @error('order')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="space-y-2">
                    <label for="status_group" class="text-sm font-medium text-gray-400">Settings</label>
                    <div class="flex flex-col gap-3 mt-2">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $faq->is_active) ? 'checked' : '' }} class="sr-only peer">
                            <div class="relative w-11 h-6 bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                            <span class="ms-3 text-sm font-medium text-gray-300">Active</span>
                        </label>

                        <div class="space-y-3">
                            <span class="text-xs font-semibold text-gray-500 uppercase">Display Location</span>
                            <div class="flex flex-col gap-2">
                                <label class="flex items-center gap-3 p-3 rounded-lg border border-white/5 bg-[#1C1E21] hover:bg-[#2A2C30] cursor-pointer transition-all">
                                    <input type="radio" name="show_on_home" value="0" {{ old('show_on_home', $faq->show_on_home) == 0 ? 'checked' : '' }} class="w-4 h-4 text-red-500 bg-gray-700 border-gray-600 focus:ring-red-500 focus:ring-2">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-medium text-gray-200">FAQ Page</span>
                                        <span class="text-xs text-gray-500">Show on the dedicated FAQ page</span>
                                    </div>
                                </label>
                                
                                <label class="flex items-center gap-3 p-3 rounded-lg border border-white/5 bg-[#1C1E21] hover:bg-[#2A2C30] cursor-pointer transition-all">
                                    <input type="radio" name="show_on_home" value="1" {{ old('show_on_home', $faq->show_on_home) == 1 ? 'checked' : '' }} class="w-4 h-4 text-red-500 bg-gray-700 border-gray-600 focus:ring-red-500 focus:ring-2">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-medium text-gray-200">Homepage</span>
                                        <span class="text-xs text-gray-500">Show on the main landing page</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-4 flex items-center justify-end gap-4">
                <a href="{{ route('admin.faqs.index') }}" class="px-6 py-3 rounded-xl bg-white/5 text-gray-300 hover:text-white hover:bg-white/10 transition-all font-medium">Cancel</a>
                <button type="submit" class="px-8 py-3 rounded-xl bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold shadow-lg shadow-red-900/20 hover:scale-[1.02] transition-all duration-300">
                    Update FAQ
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
