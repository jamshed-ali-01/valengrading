@extends('layouts.admin')

@section('title', 'Population Reports')

@section('content')
<div class="w-full space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white">Population Reports</h1>
            <p class="text-gray-400 text-sm mt-1">Manage population report entries</p>
        </div>
        <a href="{{ route('admin.population.create') }}" class="bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold px-6 py-3 rounded-xl transition-all shadow-lg shadow-red-900/40 uppercase tracking-wider text-sm hover:scale-105 active:scale-95 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add Entry
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500/20 rounded-xl p-4 text-emerald-500">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search -->
    <form action="{{ route('admin.population.index') }}" method="GET" class="bg-[#232528] border border-white/5 rounded-xl p-4">
        <div class="flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title, set, or card number..." class="flex-1 bg-[#15171A] border border-white/10 rounded-lg px-4 py-2 text-white text-sm focus:border-red-500 focus:ring-1 focus:ring-red-500 outline-none">
            <button type="submit" class="bg-white/10 hover:bg-white/20 text-white px-6 py-2 rounded-lg font-medium transition-all">
                Search
            </button>
        </div>
    </form>

    <!-- Table -->
    <div class="bg-[#232528] border border-white/5 rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-black/40 text-gray-400 uppercase text-xs font-bold tracking-wider border-b border-white/5">
                    <tr>
                        <th class="px-6 py-4 text-left">Year</th>
                        <th class="px-6 py-4 text-left">Title</th>
                        <th class="px-6 py-4 text-left">Brand</th>
                        <th class="px-6 py-4 text-left">Set</th>
                        <th class="px-6 py-4 text-left">Card No</th>
                        <th class="px-6 py-4 text-left">Rarity</th>
                        @for($i = 1; $i <= 10; $i++)
                            <th class="px-3 py-4 text-center">{{ $i }}</th>
                        @endfor
                        <th class="px-4 py-4 text-center border-l border-white/5">Total</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($reports as $report)
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="px-6 py-4 text-sm text-white">{{ $report->year ?: '-' }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-white">{{ $report->title }}</td>
                            <td class="px-6 py-4 text-xs text-gray-400">{{ $report->brand ?: '-' }}</td>
                            <td class="px-6 py-4 text-xs text-gray-400">{{ $report->set_name ?: '-' }}</td>
                            <td class="px-6 py-4 text-xs font-mono text-gray-400">{{ $report->card_number ?: '-' }}</td>
                            <td class="px-6 py-4 text-xs text-gray-400">{{ $report->rarity ?: '-' }}</td>
                            
                            @for($i = 1; $i <= 10; $i++)
                                <td class="px-3 py-4 text-center">
                                    <span class="text-xs font-bold {{ $report->{'grade_'.$i} > 0 ? 'text-white' : 'text-gray-700' }}">
                                        {{ $report->{'grade_'.$i} }}
                                    </span>
                                </td>
                            @endfor

                            <td class="px-4 py-4 text-center border-l border-white/5">
                                <span class="text-emerald-500 font-bold text-sm">{{ $report->total }}</span>
                            </td>
                            
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.population.edit', $report) }}" class="text-blue-400 hover:text-blue-300 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.population.destroy', $report) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="18" class="px-6 py-20 text-center text-gray-500">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-12 h-12 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <p class="font-medium">No population reports found.</p>
                                    <a href="{{ route('admin.population.create') }}" class="text-red-500 hover:text-red-400 text-sm font-medium">Add your first entry</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $reports->links() }}
    </div>
</div>
@endsection
