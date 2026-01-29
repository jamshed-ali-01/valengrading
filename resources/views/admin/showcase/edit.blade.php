@extends('layouts.admin')

@section('title', 'Edit Showcase Card')

@section('content')
<div class="w-full">
    <div class="bg-[#232528]/80 backdrop-blur-xl border border-white/5 rounded-2xl overflow-hidden shadow-2xl">
        <div class="p-6 border-b border-white/5 flex items-center justify-between">
            <h3 class="text-lg font-bold text-white">Edit Card #{{ $showcase->order }}</h3>
            <a href="{{ route('admin.showcase.index') }}" class="text-sm text-gray-400 hover:text-white transition-colors">
                &larr; Back to List
            </a>
        </div>
        
        <div class="p-6">
            <form action="{{ route('admin.showcase.update', $showcase) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Current Image Preview -->
                <div class="flex justify-center mb-6">
                    <div class="relative group">
                        <img src="{{ asset($showcase->image_path) }}" alt="Current Image" class="h-48 w-auto rounded-xl border-2 border-white/10 shadow-2xl">
                        <div class="absolute inset-0 bg-black/50 rounded-xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-xs font-bold text-white uppercase tracking-wider">Current Image</span>
                        </div>
                    </div>
                </div>

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Replace Image (Optional)</label>
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-white/10 rounded-xl cursor-pointer bg-[#15171A] hover:bg-white/5 transition-colors group">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-2 text-gray-400 group-hover:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="text-xs text-gray-400"><span class="font-semibold text-white">Click to replace</span></p>
                            </div>
                            <input id="dropzone-file" type="file" name="image" class="hidden" />
                        </label>
                    </div>
                    @error('image') <p class="mt-2 text-red-500 text-xs">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Order -->
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Display Order</label>
                        <input type="number" name="order" value="{{ old('order', $showcase->order) }}" 
                            class="w-full bg-[#15171A] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 transition-all placeholder-gray-600">
                        @error('order') <p class="mt-2 text-red-500 text-xs">{{ $message }}</p> @enderror
                    </div>

                    <!-- Active Toggle -->
                    <div x-data="{ active: {{ $showcase->is_active ? 'true' : 'false' }} }">
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
                <div class="pt-4 flex gap-4">
                    <button type="submit" class="flex-1 flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all uppercase tracking-widest shadow-lg shadow-red-900/20">
                        Update Card
                    </button>
                    <!-- Delete Button inside Edit -->
                    <button type="button" @click="if(confirm('Delete this card permanently?')) document.getElementById('delete-form-{{ $showcase->id }}').submit()" class="flex-none px-4 py-3 border border-red-500/20 rounded-xl text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </div>
            </form>
            
            <form id="delete-form-{{ $showcase->id }}" action="{{ route('admin.showcase.destroy', $showcase) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>
@endsection
