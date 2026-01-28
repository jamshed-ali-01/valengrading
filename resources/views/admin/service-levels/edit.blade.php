@extends('layouts.admin')

@section('title', 'Edit Service Level: ' . $serviceLevel->name)

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-[#232528]/80 backdrop-blur-xl border border-white/5 rounded-2xl p-8 shadow-2xl">
        <form method="POST" action="{{ route('admin.service-levels.update', $serviceLevel) }}" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-2">
                <label for="name" class="text-sm font-medium text-gray-400">Service Level Name*</label>
                <input type="text" id="name" name="name" value="{{ old('name', $serviceLevel->name) }}" 
                    class="w-full bg-[#15171A] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 transition-colors"
                    placeholder="e.g., Express, Standard" required>
                @error('name')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="space-y-2">
                <label for="submission_type_id" class="text-sm font-medium text-gray-400">Submission Type (Parent)*</label>
                <select id="submission_type_id" name="submission_type_id" required class="w-full bg-[#15171A] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 transition-colors appearance-none">
                    <option value="">Select Parent Service</option>
                    @foreach($submissionTypes as $type)
                        <option value="{{ $type->id }}" {{ (old('submission_type_id', $serviceLevel->submission_type_id) == $type->id) ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
                @error('submission_type_id')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>
            
            <div class="space-y-2">
                <label for="delivery_time" class="text-sm font-medium text-gray-400">Delivery Time*</label>
                <input type="text" id="delivery_time" name="delivery_time" value="{{ old('delivery_time', $serviceLevel->delivery_time) }}" 
                    class="w-full bg-[#15171A] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 transition-colors"
                    placeholder="e.g., 15-20 Business Days" required>
                @error('delivery_time')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label for="min_submission" class="text-sm font-medium text-gray-400">Min Cards</label>
                    <input type="number" id="min_submission" name="min_submission" value="{{ old('min_submission', $serviceLevel->min_submission) }}" 
                        class="w-full bg-[#15171A] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 transition-colors"
                        placeholder="None">
                    @error('min_submission')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div class="space-y-2">
                    <label for="price_per_card" class="text-sm font-medium text-gray-400">Price Per Card (€)*</label>
                    <input type="number" step="0.01" id="price_per_card" name="price_per_card" value="{{ old('price_per_card', $serviceLevel->price_per_card) }}" 
                        class="w-full bg-[#15171A] border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-red-500 transition-colors"
                        required>
                    @error('price_per_card')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="space-y-2">
                    <label for="order" class="text-sm font-medium text-gray-400">Order*</label>
                    <input type="number" id="order" name="order" value="{{ old('order', $serviceLevel->order) }}" 
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
                    <option value="1" {{ old('is_active', $serviceLevel->is_active) == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('is_active', $serviceLevel->is_active) == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('is_active')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>
            
            <div class="pt-4 flex items-center justify-end gap-4">
                <a href="{{ route('admin.service-levels.index') }}" class="px-6 py-3 rounded-xl bg-white/5 text-gray-300 hover:text-white hover:bg-white/10 transition-all font-medium">Cancel</a>
                <button type="submit" class="px-8 py-3 rounded-xl bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold shadow-lg shadow-red-900/20 hover:scale-[1.02] transition-all duration-300">
                    Update Service Level
                </button>
            </div>
        </form>
    </div>
</div>
@endsection