@extends('layouts.admin')

@section('title', 'Service Levels Management')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-white flex items-center gap-2">
            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
            Service Levels
        </h3>
        <a href="{{ route('admin.service-levels.create') }}" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold shadow-lg shadow-red-900/20 hover:scale-[1.02] transition-all duration-300 text-sm">
            Add New Service Level
        </a>
    </div>

    <div class="bg-[#232528]/80 backdrop-blur-xl border border-white/5 rounded-2xl overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-white/5 text-gray-400 uppercase text-[10px] font-bold tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Order</th>
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4 text-center">Delivery</th>
                        <th class="px-6 py-4 text-center">Min Cards</th>
                        <th class="px-6 py-4 text-center">Price/Card</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($serviceLevels as $level)
                        <tr class="hover:bg-white/[0.02] transition-colors group">
                            <td class="px-6 py-4 text-gray-500 font-mono">{{ $level->order }}</td>
                            <td class="px-6 py-4 font-bold text-white">{{ $level->name }}</td>
                            <td class="px-6 py-4 text-center text-gray-300">{{ $level->delivery_time }}</td>
                            <td class="px-6 py-4 text-center text-gray-300">
                                @if($level->min_submission)
                                    <span class="bg-white/5 px-2 py-1 rounded text-xs">{{ $level->min_submission }} cards</span>
                                @else
                                    <span class="text-gray-600 italic">None</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-emerald-400 font-bold tabular-nums text-base">€{{ number_format($level->price_per_card, 2) }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $level->is_active ? 'bg-emerald-500/20 text-emerald-400' : 'bg-red-500/20 text-red-400' }}">
                                    {{ $level->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('admin.service-levels.edit', $level) }}" class="p-2 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.service-levels.destroy', $level) }}" method="POST" onsubmit="return confirm('Delete this service level?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection