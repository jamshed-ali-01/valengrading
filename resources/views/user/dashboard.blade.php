@extends('layouts.frontend')

@section('content')
    <div x-data="{ activeTab: 'overview' }" class="pb-20 pt-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <!-- Dashboard Header -->
        <div class="mb-10">
            <h1 class="text-3xl font-bold text-white mb-2">My Dashboard</h1>
            <p class="text-gray-400">Track your card grading submissions and manage your account</p>
        </div>

        <!-- 4 Stats Cards Row -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <!-- Total Submissions -->
            <div
                class="bg-[var(--color-valen-light)] rounded-lg p-6 border border-[var(--color-valen-border)] relative overflow-hidden group">
                <div class="flex flex-col justify-between h-full min-h-[90px]">
                    <span class="text-xs text-gray-400 font-medium uppercase tracking-wide">Total Submissions</span>
                    <div class="flex justify-between items-end">
                        <span class="text-4xl font-bold text-white">{{ $totalSubmissions }}</span>
                        <div class="text-[var(--color-primary)] opacity-80">
                            <svg class="size-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cards Graded -->
            <div
                class="bg-[var(--color-valen-light)] rounded-lg p-6 border border-[var(--color-valen-border)] relative overflow-hidden group">
                <div class="flex flex-col justify-between h-full min-h-[90px]">
                    <span class="text-xs text-gray-400 font-medium uppercase tracking-wide">Cards Graded</span>
                    <div class="flex justify-between items-end">
                        <span class="text-4xl font-bold text-white">{{ $cardsGraded }}</span>
                        <div class="text-green-500 opacity-80">
                            <svg class="size-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submission In Progress -->
            <div
                class="bg-[var(--color-valen-light)] rounded-lg p-6 border border-[var(--color-valen-border)] relative overflow-hidden group">
                <div class="flex flex-col justify-between h-full min-h-[90px]">
                    <span class="text-xs text-gray-400 font-medium uppercase tracking-wide">Submission In Progress</span>
                    <div class="flex justify-between items-end">
                        <span class="text-4xl font-bold text-white">{{ $inProgress }}</span>
                        <div class="text-blue-500 opacity-80">
                            <svg class="size-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Spent -->
            <div
                class="bg-[var(--color-valen-light)] rounded-lg p-6 border border-[var(--color-valen-border)] relative overflow-hidden group">
                <div class="flex flex-col justify-between h-full min-h-[90px]">
                    <span class="text-xs text-gray-400 font-medium uppercase tracking-wide">Total Spent</span>
                    <div class="flex justify-between items-end">
                        <span class="text-4xl font-bold text-white">{{ number_format($totalSpent, 2) }}</span>
                        <div class="text-[var(--color-primary)] font-bold text-4xl opacity-80">$</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Segmented Tab Navigation -->
        <div
            class="bg-[var(--color-valen-light)] rounded-lg border border-[var(--color-valen-border)] p-1 grid grid-cols-4 gap-1 mb-8">
            <button @click="activeTab = 'overview'"
                class="flex items-center justify-center py-3 rounded text-sm font-medium transition-all duration-300"
                :class="activeTab === 'overview' ? 'bg-[var(--color-primary)] text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-white/5'">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </button>
            <button @click="activeTab = 'cards'"
                class="flex items-center justify-center py-3 rounded text-sm font-medium transition-all duration-300"
                :class="activeTab === 'cards' ? 'bg-[var(--color-primary)] text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-white/5'">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </button>
            <button @click="activeTab = 'status'"
                class="flex items-center justify-center py-3 rounded text-sm font-medium transition-all duration-300"
                :class="activeTab === 'status' ? 'bg-[var(--color-primary)] text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-white/5'">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </button>
            <button @click="activeTab = 'profile'"
                class="flex items-center justify-center py-3 rounded text-sm font-medium transition-all duration-300"
                :class="activeTab === 'profile' ? 'bg-[var(--color-primary)] text-white shadow-lg' : 'text-gray-400 hover:text-white hover:bg-white/5'">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </button>
        </div>

        <!-- Content Area with Glass Effect -->
        <div class="glass-effect rounded-lg p-1 min-h-[500px] animate-slide-up">

            <!-- OVERVIEW TAB -->
            <div x-show="activeTab === 'overview'"
                class="p-8 flex flex-col items-center justify-center h-full min-h-[400px]">
                <h2 class="text-2xl font-bold text-white mb-2">Welcome Back!</h2>
                <p class="text-gray-400 mb-12">Here's a summary of your recent grading activity</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full max-w-4xl mb-12">
                    <!-- Cards Completed Block -->
                    <div
                        class="bg-[var(--color-valen-light)]/50 border border-[var(--color-valen-border)] rounded-xl p-8 flex flex-col items-center justify-center hover:border-green-500/50 transition-colors cursor-pointer group">
                        <div
                            class="w-12 h-12 rounded-full border border-green-500/30 flex items-center justify-center mb-4 text-green-500 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-1">{{ $cardsGraded }} Cards Completed</h3>
                        <p class="text-sm text-gray-500">Your total graded collection</p>
                    </div>

                    <!-- Cards In Progress Block -->
                    <div
                        class="bg-[var(--color-valen-light)]/50 border border-[var(--color-valen-border)] rounded-xl p-8 flex flex-col items-center justify-center hover:border-blue-500/50 transition-colors cursor-pointer group">
                        <div
                            class="w-12 h-12 rounded-full border border-blue-500/30 flex items-center justify-center mb-4 text-blue-500 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-1">{{ $totalSubmissions - $submissions->where('status', 'completed')->count() }} Submissions Active</h3>
                        <p class="text-sm text-gray-500">Currently in the grading process</p>
                    </div>
                </div>

                <a href="{{ route('multiform') }}"
                    class="bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] text-white px-8 py-3 rounded text-sm font-semibold transition-all shadow-[0_0_20px_rgba(163,5,10,0.4)] hover:shadow-[0_0_30px_rgba(163,5,10,0.6)]">
                    Submit New Cards
                </a>
            </div>

            <!-- MY CARDS TAB -->
            <div x-show="activeTab === 'cards'" class="p-8" style="display: none;">
                <h2 class="text-xl font-bold text-white mb-8 text-center">My Card Collection</h2>

                <div class="space-y-4">
                    @forelse($myCards as $card)
                    <div
                        class="bg-[var(--color-valen-dark)] border border-[var(--color-valen-border)] rounded-lg p-6 flex flex-col md:flex-row items-center justify-between gap-6 hover:border-[var(--color-valen-border)]/80 transition-colors group">
                        <div class="flex items-center gap-6 w-full">
                            <!-- Image Placeholder or Actual Image -->
                            <div class="w-24 h-32 bg-[var(--color-valen-light)] rounded border border-[var(--color-valen-border)] flex-shrink-0 overflow-hidden relative">
                                @if($card->grading_image)
                                    <img src="{{ asset($card->grading_image) }}" alt="{{ $card->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-600">
                                        <svg class="w-8 h-8 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                
                                @if($card->grade)
                                    <div class="absolute top-0 right-0 bg-[var(--color-primary)] text-white text-xs font-bold px-1.5 py-0.5 rounded-bl">
                                        {{ $card->grade }}
                                    </div>
                                @endif
                            </div>

                            <div>
                                <h3 class="text-white font-bold text-lg">{{ $card->title ?? 'Untitled Card' }}</h3>
                                <p class="text-gray-400 text-sm mb-4">{{ $card->set_name }} • {{ $card->year }}</p>

                                @if($card->grade)
                                <div class="inline-flex items-center gap-2 bg-green-500/10 text-green-500 px-3 py-1 rounded-full text-xs font-bold border border-green-500/20">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Graded: {{ $card->grade }}
                                </div>
                                @else
                                <span class="bg-yellow-500/10 text-yellow-500 px-3 py-1 rounded-full text-xs font-bold border border-yellow-500/20">
                                    In Grading
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="flex gap-4 pr-4">
                            @if($card->grading_report_path)
                            <a href="{{ asset($card->grading_report_path) }}" target="_blank"
                                class="flex flex-col items-center gap-1 text-gray-500 hover:text-[var(--color-primary)] transition-colors group/btn">
                                <svg class="w-5 h-5 text-[var(--color-primary)] opacity-70 group-hover/btn:opacity-100 transition-opacity"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="text-[10px] uppercase font-bold tracking-wider">Report</span>
                            </a>
                            @endif
                            
                            <a href="{{ route('pop-report') }}"
                                class="flex flex-col items-center gap-1 text-gray-500 hover:text-[var(--color-primary)] transition-colors group/btn">
                                <svg class="w-5 h-5 text-[var(--color-primary)] opacity-70 group-hover/btn:opacity-100 transition-opacity"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                <span class="text-[10px] uppercase font-bold tracking-wider">Pop Report</span>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <p class="text-gray-400 mb-4">You haven't submitted any cards yet.</p>
                        <a href="{{ route('multiform') }}" class="text-[var(--color-primary)] hover:underline">Start a Submission</a>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- ORDER STATUS TAB -->
            <div x-show="activeTab === 'status'" class="p-8" style="display: none;">
                <h2 class="text-xl font-bold text-white mb-8 text-center">My Order Status</h2>

                <div class="space-y-6">
                    @forelse($submissions as $submission)
                    <div class="bg-[var(--color-valen-dark)]/50 border border-[var(--color-valen-border)] rounded-lg p-6">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                            <div>
                                <h3 class="text-white font-bold text-lg mb-1">Order #{{ $submission->submission_no }}</h3>
                                <p class="text-gray-400 text-sm">Submitted on {{ $submission->created_at->format('F j, Y') }}</p>
                            </div>
                            <div class="mt-2 md:mt-0 flex items-center gap-2 text-sm text-gray-300">
                                Current Status: <span class="text-[var(--color-primary)] font-bold uppercase">{{ ucfirst(str_replace('_', ' ', $submission->status)) }}</span>
                            </div>
                        </div>

                        <!-- Status Grid (Simplistic Visual Tracker) -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Helper to check completion based on status enum -->
                            @php
                                $status = $submission->status;
                                $progress = 0;
                                // Map backend status to visual progress steps
                                // 1: Received (Paid/Processing+)
                                // 2: In Grading (Processing+) -- Assuming processing implies grading started
                                // 3: Completed (Shipped/Completed)
                                
                                if(in_array($status, ['paid', 'processing', 'shipped', 'completed'])) $progress = 1;
                                if(in_array($status, ['processing', 'shipped', 'completed'])) $progress = 2;
                                if(in_array($status, ['shipped', 'completed'])) $progress = 3;
                            @endphp

                            <!-- Step 1: Received -->
                            <div class="bg-[var(--color-valen-light)]/40 border {{ $progress >= 1 ? 'border-green-900/50' : 'border-gray-800' }} rounded flex items-center p-3 gap-3">
                                <div class="w-5 h-5 rounded-full border {{ $progress >= 1 ? 'border-green-500 text-green-500' : 'border-gray-600 text-gray-600' }} flex items-center justify-center">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                </div>
                                <span class="{{ $progress >= 1 ? 'text-green-500' : 'text-gray-500' }} text-sm font-medium">Received</span>
                            </div>

                            <!-- Step 2: Grading/Processing -->
                            <div class="bg-[var(--color-valen-light)]/40 border {{ $progress >= 2 ? 'border-green-900/50' : ($progress == 2 ? 'border-[var(--color-primary)]/30' : 'border-gray-800') }} rounded flex items-center p-3 gap-3 relative overflow-hidden">
                                <div class="w-5 h-5 rounded-full border {{ $progress > 2 ? 'border-green-500 text-green-500' : ($progress == 2 ? 'border-[var(--color-primary)] text-[var(--color-primary)]' : 'border-gray-600 text-gray-600') }} flex items-center justify-center">
                                    @if($progress > 2)
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                    @elseif($progress == 2)
                                        <div class="w-2.5 h-2.5 bg-[var(--color-primary)] rounded-full animate-pulse"></div>
                                    @else
                                        <div class="w-2.5 h-2.5 bg-gray-600 rounded-full"></div>
                                    @endif
                                </div>
                                <span class="{{ $progress > 2 ? 'text-green-500' : ($progress == 2 ? 'text-[var(--color-primary)]' : 'text-gray-500') }} text-sm font-medium">In Grading</span>
                            </div>

                            <!-- Step 3: Completed/Shipped -->
                            <div class="bg-[var(--color-valen-light)]/40 border {{ $progress >= 3 ? 'border-green-900/50' : 'border-gray-800' }} rounded flex items-center p-3 gap-3">
                                <div class="w-5 h-5 rounded-full border {{ $progress >= 3 ? 'border-green-500 text-green-500' : 'border-gray-600 text-gray-600' }} flex items-center justify-center">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                </div>
                                <span class="{{ $progress >= 3 ? 'text-green-500' : 'text-gray-500' }} text-sm font-medium">Completed</span>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12">
                        <p class="text-gray-400">No recent orders found.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- MY PROFILE TAB -->
            <div x-show="activeTab === 'profile'" class="p-8" style="display: none;">
                <div class="grid grid-cols-1 gap-12 max-w-5xl mx-auto">
                    <div class="bg-transparent">
                        <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                            <span class="w-1.5 h-6 bg-[var(--color-primary)] rounded-sm"></span>
                            Personal Information
                        </h3>
                        <!-- Note: User model has single 'name'. Splitting for display if needed or just using First Name for Full Name -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-ui.valen-input label="First Name" name="first_name" placeholder="First Name" :value="$user->name" />
                            <x-ui.valen-input label="Last Name" name="last_name" placeholder="Last Name" />
                            <x-ui.valen-input label="Email Address" name="email" placeholder="email@example.com" :value="$user->email" />
                            <x-ui.valen-input label="Phone Number" name="phone" placeholder="+1 (555) 000-0000" :value="$latestAddress->number ?? ''" />
                        </div>
                        <div class="mt-6 text-right">
                            <x-ui.valen-button>Save Personal Information</x-ui.valen-button>
                        </div>
                    </div>

                    <div class="bg-transparent">
                        <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                            <span class="w-1.5 h-6 bg-[var(--color-primary)] rounded-sm"></span>
                            Delivery Address
                        </h3>
                        <div class="space-y-6">
                            <x-ui.valen-input label="Street Address" name="street" placeholder="Street Address" :value="$latestAddress->address_line_1 ?? ''" />
                            <div class="grid grid-cols-3 gap-6">
                                <x-ui.valen-input label="City" name="city" placeholder="City" :value="$latestAddress->city ?? ''" />
                                <x-ui.valen-input label="State" name="state" placeholder="State/County" :value="$latestAddress->county ?? ''" />
                                <x-ui.valen-input label="Zip Code" name="zip" placeholder="Zip Code" :value="$latestAddress->post_code ?? ''" />
                            </div>
                            <x-ui.valen-input label="Country" name="country" placeholder="Country" :value="$latestAddress->country ?? ''" />
                        </div>
                        <div class="mt-6 text-right">
                            <x-ui.valen-button>Save Delivery Address</x-ui.valen-button>
                        </div>
                    </div>

                    <div class="bg-transparent">
                        <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                            <span class="w-1.5 h-6 bg-[var(--color-primary)] rounded-sm"></span>
                            Change Password
                        </h3>
                        <div class="gap-6 grid grid-cols-1 md:grid-cols-2">
                            <x-ui.valen-input label="Current Password" type="password" name="current_password"
                                placeholder="••••••••" />
                            <x-ui.valen-input label="New Password" type="password" name="new_password"
                                placeholder="••••••••" />
                            <x-ui.valen-input label="Confirm New Password" type="password" name="confirm_password"
                                placeholder="••••••••" />
                        </div>
                        <div class="mt-6 text-right">
                            <x-ui.valen-button>Change Password</x-ui.valen-button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection