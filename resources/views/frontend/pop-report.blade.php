@extends('layouts.frontend')

@section('content')
    <div class="bg-[var(--color-valen-dark)] min-h-screen py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Search Section -->
            <form action="{{ route('pop-report') }}" method="GET" class="flex flex-col md:flex-row gap-4 mb-20 items-center max-w-5xl mx-auto w-full">
                <div class="w-full relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="bg-transparent border border-[#331111] text-gray-400 text-sm rounded-lg focus:ring-1 focus:ring-[var(--color-primary)] focus:border-[var(--color-primary)] block w-full p-4 placeholder-gray-600"
                        placeholder="e.g. &quot;Pikachu Vmax&quot;">
                </div>
                <button type="submit"
                    class="w-full md:w-auto px-12 py-4 bg-[#A32014] hover:bg-[#801a11] text-white font-bold rounded-lg transition-colors shadow-lg">
                    Search
                </button>
            </form>

            <!-- Table Container with thin red outline -->
            <div class="border border-[#331111] rounded-xl overflow-hidden shadow-2xl bg-[#0D0F12]">
                <div class="overflow-x-auto">
                    <table class="w-full text-[11px] text-left text-gray-400 border-collapse">
                        <thead class="text-white bg-black/60">
                            <tr>
                                <th scope="col" class="px-6 py-5 font-medium">Year</th>
                                <th scope="col" class="px-6 py-5 font-medium">Card Name</th>
                                <th scope="col" class="px-6 py-5 font-medium">Brand</th>
                                <th scope="col" class="px-6 py-5 font-medium">Set</th>
                                <th scope="col" class="px-6 py-5 font-medium text-center">Card No</th>
                                <th scope="col" class="px-6 py-5 font-medium">Rarity</th>
                                @for($i = 1; $i <= 10; $i++)
                                    <th scope="col" class="px-2 py-5 text-center font-medium">{{ $i }}</th>
                                @endfor
                                <th scope="col" class="px-6 py-5 text-center font-medium text-white">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-black/20">
                            @forelse($reports as $report)
                                <tr class="transition-colors hover:bg-[#A32014] group {{ $loop->even ? 'bg-[#181A1D]' : 'bg-[#111316]' }}">
                                    <td class="px-6 py-4 font-medium text-gray-300 group-hover:text-white">{{ $report->year }}</td>
                                    <td class="px-6 py-4 font-normal text-white">{{ $report->title }}</td>
                                    <td class="px-6 py-4 text-gray-300 group-hover:text-white">{{ $report->brand }}</td>
                                    <td class="px-6 py-4 text-gray-300 group-hover:text-white">{{ $report->set_name }}</td>
                                    <td class="px-6 py-4 text-center text-gray-300 group-hover:text-white">{{ $report->card_number }}</td>
                                    <td class="px-6 py-4 text-gray-300 group-hover:text-white">{{ $report->rarity }}</td>
                                    
                                    <td class="px-2 py-4 text-center text-gray-300 group-hover:text-white">{{ $report->grade_1 }}</td>
                                    <td class="px-2 py-4 text-center text-gray-300 group-hover:text-white">{{ $report->grade_2 }}</td>
                                    <td class="px-2 py-4 text-center text-gray-300 group-hover:text-white">{{ $report->grade_3 }}</td>
                                    <td class="px-2 py-4 text-center text-gray-300 group-hover:text-white">{{ $report->grade_4 }}</td>
                                    <td class="px-2 py-4 text-center text-gray-300 group-hover:text-white">{{ $report->grade_5 }}</td>
                                    <td class="px-2 py-4 text-center text-gray-300 group-hover:text-white">{{ $report->grade_6 }}</td>
                                    <td class="px-2 py-4 text-center text-gray-300 group-hover:text-white">{{ $report->grade_7 }}</td>
                                    <td class="px-2 py-4 text-center text-gray-300 group-hover:text-white">{{ $report->grade_8 }}</td>
                                    <td class="px-2 py-4 text-center text-gray-300 group-hover:text-white">{{ $report->grade_9 }}</td>
                                    <td class="px-2 py-4 text-center text-gray-300 group-hover:text-white">{{ $report->grade_10 }}</td>
                                    
                                    <td class="px-6 py-4 text-center font-bold text-white">{{ $report->total_graded }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="17" class="px-6 py-8 text-center text-gray-400">
                                        No population reports found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="mt-8">
                {{ $reports->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection