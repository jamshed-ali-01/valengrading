@extends('layouts.admin')

@section('title', 'Add Showcase Card')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-[#232528]/80 backdrop-blur-xl border border-white/5 rounded-2xl overflow-hidden shadow-2xl">
        <div class="p-6 border-b border-white/5 flex items-center justify-between">
            <h3 class="text-lg font-bold text-white">Add New Card</h3>
            <a href="{{ route('admin.showcase.index') }}" class="text-sm text-gray-400 hover:text-white transition-colors">
                &larr; Back to List
            </a>
        </div>
        
        <div class="p-6">
            <form action="{{ route('admin.showcase.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Card Image</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-dashed border-white/10 rounded-xl cursor-pointer bg-[#15171A] hover:bg-white/5 transition-colors group">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-10 h-10 mb-3 text-gray-400 group-hover:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="mb-2 text-sm text-gray-400"><span class="font-semibold text-white">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500">PNG, JPG, WEBP (MAX. 2MB)</p>
                            </div>
                            <input id="dropzone-file" type="file" name="image" class="hidden" required />
                        </label>
                    </div>
                    @error('image') <p class="mt-2 text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Order -->
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Display Order</label>
                        <input type="number" name="order" value="0" 
                            class="w-full bg-[#15171A] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all placeholder-gray-600">
                        @error('order') <p class="mt-2 text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <!-- Active Toggle -->
                    <div x-data="{ active: true }">
                        <label class="block text-sm font-medium text-gray-400 mb-2">Active Status</label>
                        <div class="w-full bg-[#15171A] border border-white/10 rounded-xl px-4 py-3 flex items-center gap-4">
                            <input type="hidden" name="is_active" :value="active ? 1 : 0">
                            <button type="button" 
                                class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                :class="active ? 'bg-red-600' : 'bg-gray-700'"
                                role="switch" 
                                @click="active = !active">
                                <span aria-hidden="true" 
                                    class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                    :class="active ? 'translate-x-5' : 'translate-x-0'">
                                </span>
                            </button>
                            <span class="text-sm font-medium" :class="active ? 'text-white' : 'text-gray-500'" x-text="active ? 'Enabled' : 'Disabled'"></span>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all uppercase tracking-widest shadow-lg shadow-red-900/20">
                        Save Card
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
