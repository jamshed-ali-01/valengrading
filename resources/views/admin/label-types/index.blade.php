@extends('layouts.admin')

@section('title', 'Label Types Management')

@section('content')
<div class="space-y-6" x-data="{ search: '' }">
    <div class="bg-[#232528]/80 backdrop-blur-xl border border-white/5 rounded-2xl overflow-hidden shadow-2xl">
        <div class="p-6 border-b border-white/5 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M13 7h.01M13 11h.01M13 15h.01M17 7h.01M17 11h.01M17 15h.01"></path></svg>
                Label Types
            </h3>
            <div class="flex flex-wrap items-center gap-4">
                <!-- Search Bar -->
                <div class="relative group">
                    <input type="text" x-model="search" placeholder="Search label..." 
                        class="bg-[#15171A] border border-white/10 rounded-xl px-4 py-2 text-xs text-white focus:outline-none focus:border-red-500 transition-all w-64 pl-10">
                    <svg class="w-4 h-4 text-gray-500 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <a href="{{ route('admin.label-types.create') }}" class="px-6 py-2 rounded-xl bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold shadow-lg shadow-red-900/20 hover:scale-[1.02] transition-all duration-300 text-xs uppercase tracking-widest">
                    Add New
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-white/5 text-gray-400 uppercase text-[10px] font-bold tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Order</th>
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Description</th>
                        <th class="px-6 py-4 text-center">Display Price</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($labelTypes as $type)
                        <tr class="hover:bg-white/[0.02] transition-colors group"
                            x-show="search === '' || '{{ strtolower($type->name . ' ' . $type->description) }}'.includes(search.toLowerCase())">
                            <td class="px-6 py-4 text-gray-500 font-mono">{{ $type->order }}</td>
                            <td class="px-6 py-4 font-bold text-white">{{ $type->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-400 max-w-xs truncate">{{ $type->description }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="bg-red-500/10 text-red-400 px-3 py-1 rounded-lg font-bold tabular-nums">
                                    {{ $type->display_price }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $type->is_active ? 'bg-emerald-500/20 text-emerald-400' : 'bg-red-500/20 text-red-400' }}">
                                    {{ $type->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.label-types.edit', $type) }}" class="p-2 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.label-types.destroy', $type) }}" method="POST" onsubmit="return confirm('Delete this label type?')">
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