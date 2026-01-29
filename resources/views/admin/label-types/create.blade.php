@extends('layouts.admin')

@section('title', 'Add New Label Type')

@section('content')
<div class="w-full">
    <div class="bg-[#232528]/80 backdrop-blur-xl border border-white/5 rounded-2xl p-8 shadow-2xl">
        <form method="POST" action="{{ route('admin.label-types.store') }}" class="space-y-6">
            @csrf
            
            <div class="space-y-2">
                <label for="name" class="text-sm font-medium text-gray-400">Label Type Name*</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" 
                    class="w-full bg-[#15171A] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 transition-colors"
                    placeholder="e.g., Classic, Premium, Custom" required>
                @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>
            
            <div class="space-y-2">
                <label for="description" class="text-sm font-medium text-gray-400">Description</label>
                <input type="text" id="description" name="description" value="{{ old('description') }}" 
                    class="w-full bg-[#15171A] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 transition-colors"
                    placeholder="e.g., Classic (Free), Premium (+5)">
                @error('description')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="price_adjustment" class="text-sm font-medium text-gray-400">Price Adjustment (€)*</label>
                    <input type="number" step="0.01" id="price_adjustment" name="price_adjustment" value="{{ old('price_adjustment', 0) }}" 
                        class="w-full bg-[#15171A] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 transition-colors"
                        required>
                    <p class="text-[10px] text-gray-500 uppercase tracking-wider">Additional price (0 for free)</p>
                    @error('price_adjustment')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div class="space-y-2">
                    <label for="order" class="text-sm font-medium text-gray-400">Display Order*</label>
                    <input type="number" id="order" name="order" value="{{ old('order', 0) }}" 
                        class="w-full bg-[#15171A] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 transition-colors"
                        required>
                    @error('order')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            
            <div class="space-y-2">
                <label for="is_active" class="text-sm font-medium text-gray-400">Status*</label>
                <select id="is_active" name="is_active" 
                    class="w-full bg-[#15171A] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 transition-colors appearance-none"
                    required>
                    <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('is_active', '1') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('is_active')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>
            
            <div class="pt-4 flex items-center justify-end gap-4">
                <a href="{{ route('admin.label-types.index') }}" class="px-6 py-3 rounded-xl bg-white/5 text-gray-300 hover:text-white hover:bg-white/10 transition-all font-medium">Cancel</a>
                <button type="submit" class="px-8 py-3 rounded-xl bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold shadow-lg shadow-red-900/20 hover:scale-[1.02] transition-all duration-300">
                    Create Label Type
                </button>
            </div>
        </form>
    </div>
</div>
@endsection