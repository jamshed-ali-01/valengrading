@extends('layouts.frontend')

@section('content')
    <div class="bg-[var(--color-valen-dark)] min-h-screen py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Label Options -->
            <div class="mb-24">
                <div class="text-center mb-16">
                    <h1 class="text-4xl font-extrabold text-white sm:text-5xl mb-4">Label Options</h1>
                    <p class="text-gray-400 text-lg">Choose your preferred label design and service level</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Classic -->
                    <div
                        class="group relative bg-[#1C1E21] border border-[var(--color-valen-border)] rounded-2xl p-10 text-center transition-all duration-300 hover:border-[var(--color-primary)] hover:shadow-[0_0_30px_rgba(163,5,10,0.15)] hover:-translate-y-2">
                        <h3 class="text-xl font-bold text-white mb-2">Classic Label</h3>
                        <div class="text-4xl font-black text-[var(--color-primary)] mb-2">$0 <span
                                class="text-sm font-medium text-gray-400">/ per card</span></div>
                        <p class="text-xs text-gray-500 mb-8 uppercase tracking-widest">Included with submission price</p>
                        <ul class="text-sm text-gray-400 text-left space-y-4 mb-8 pl-4">
                            <li class="flex items-center"><svg class="w-4 h-4 text-[var(--color-primary)] mr-3" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg> Clean, timeless design</li>
                            <li class="flex items-center"><svg class="w-4 h-4 text-[var(--color-primary)] mr-3" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg> Clear Information</li>
                            <li class="flex items-center"><svg class="w-4 h-4 text-[var(--color-primary)] mr-3" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg> QR Code Authentication</li>
                        </ul>
                    </div>

                    <!-- Premium -->
                    <div
                        class="group relative bg-[#1C1E21] border border-[var(--color-valen-border)] rounded-2xl p-10 text-center transition-all duration-300 hover:border-[var(--color-primary)] hover:shadow-[0_0_30px_rgba(163,5,10,0.15)] hover:-translate-y-2">
                        <h3 class="text-xl font-bold text-white mb-2">Premium Label</h3>
                        <div class="text-4xl font-black text-[var(--color-primary)] mb-2">$5 <span
                                class="text-sm font-medium text-gray-400">/ per card</span></div>
                        <p class="text-xs text-gray-500 mb-8 uppercase tracking-widest">Enhanced features & security</p>
                        <ul class="text-sm text-gray-400 text-left space-y-4 mb-8 pl-4">
                            <li class="flex items-center"><svg class="w-4 h-4 text-[var(--color-primary)] mr-3" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg> Holographic elements</li>
                            <li class="flex items-center"><svg class="w-4 h-4 text-[var(--color-primary)] mr-3" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg> Premium foil text</li>
                            <li class="flex items-center"><svg class="w-4 h-4 text-[var(--color-primary)] mr-3" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg> Superior security</li>
                        </ul>
                    </div>

                    <!-- Custom -->
                    <div
                        class="group relative bg-[#1C1E21] border border-[var(--color-valen-border)] rounded-2xl p-10 text-center transition-all duration-300 hover:border-[var(--color-primary)] hover:shadow-[0_0_30px_rgba(163,5,10,0.15)] hover:-translate-y-2">
                        <h3 class="text-xl font-bold text-white mb-2">Custom Label</h3>
                        <div class="text-4xl font-black text-[var(--color-primary)] mb-2">$15 <span
                                class="text-sm font-medium text-gray-400">/ per card</span></div>
                        <p class="text-xs text-gray-500 mb-8 uppercase tracking-widest">Fully customizable design</p>
                        <ul class="text-sm text-gray-400 text-left space-y-4 mb-8 pl-4">
                            <li class="flex items-center"><svg class="w-4 h-4 text-[var(--color-primary)] mr-3" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg> Submit your own art</li>
                            <li class="flex items-center"><svg class="w-4 h-4 text-[var(--color-primary)] mr-3" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg> Exclusive designs</li>
                            <li class="flex items-center"><svg class="w-4 h-4 text-[var(--color-primary)] mr-3" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg> All premium features</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Service Levels & Pricing -->
            <div class="mb-24" x-data="{ activeTab: 'grading' }">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-extrabold text-white mb-4">Service Levels & Pricing</h2>
                    <p class="text-gray-400 max-w-2xl mx-auto">Choose the service level that best fits your needs and
                        budget. All options include our industry-leading quality standards.</p>
                </div>

                <!-- Tabs -->
                <div class="flex justify-center mb-12">
                    <div class="bg-white/10 backdrop-blur-md rounded-full p-1 flex border border-white/10">
                        <button @click="activeTab = 'grading'"
                            :class="{ 'bg-[var(--color-primary)] text-white shadow-lg': activeTab === 'grading', 'text-gray-300 hover:text-white hover:bg-white/5': activeTab !== 'grading' }"
                            class="px-6 sm:px-8 py-2.5 rounded-full font-bold text-sm transition-all duration-300">Grading</button>
                        <button @click="activeTab = 'autograph'"
                            :class="{ 'bg-[var(--color-primary)] text-white shadow-lg': activeTab === 'autograph', 'text-gray-300 hover:text-white hover:bg-white/5': activeTab !== 'autograph' }"
                            class="px-6 sm:px-8 py-2.5 rounded-full font-bold text-sm transition-all duration-300">Autograph</button>
                        <button @click="activeTab = 'reholder'"
                            :class="{ 'bg-[var(--color-primary)] text-white shadow-lg': activeTab === 'reholder', 'text-gray-300 hover:text-white hover:bg-white/5': activeTab !== 'reholder' }"
                            class="px-6 sm:px-8 py-2.5 rounded-full font-bold text-sm transition-all duration-300">Re-Holder</button>
                        <button @click="activeTab = 'authentication'"
                            :class="{ 'bg-[var(--color-primary)] text-white shadow-lg': activeTab === 'authentication', 'text-gray-300 hover:text-white hover:bg-white/5': activeTab !== 'authentication' }"
                            class="px-6 sm:px-8 py-2.5 rounded-full font-bold text-sm transition-all duration-300">Authentication</button>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="relative min-h-[500px]">
                    
                    <!-- Grading Content -->
                    <div x-show="activeTab === 'grading'" 
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 translate-y-8"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-300 absolute top-0 w-full"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-8"
                         class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full">
                        <!-- Standard -->
                        <div
                            class="bg-[#1C1E21] border border-[var(--color-valen-border)] rounded-2xl p-8 flex flex-col items-center text-center transition-all duration-300 hover:border-[var(--color-primary)] hover:shadow-[0_0_30px_rgba(163,5,10,0.15)] group relative overflow-hidden">
                            <div
                                class="w-12 h-12 rounded-lg bg-[#2A1215] flex items-center justify-center text-[var(--color-primary)] mb-6">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">Standard</h3>
                            <p class="text-xs text-gray-500 mb-6">Perfect for new collectors</p>
                            <div class="text-4xl font-black text-[var(--color-primary)] mb-6">$15 <span
                                    class="text-sm font-medium text-gray-400">/ per card</span></div>
                            <div class="text-sm text-white font-bold mb-8">Turnaround: <span
                                    class="text-gray-400 font-normal">45 Business Days</span></div>

                            <ul class="text-sm text-gray-400 text-left space-y-3 mb-8 w-full">
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg> Authentication</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg> Expert Grading</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg> Encapsulation</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg> Basic insurance</li>
                            </ul>
                            <button
                                class="mt-auto w-full py-3 rounded-lg border border-[var(--color-valen-border)] text-white hover:bg-[var(--color-primary)] hover:border-[var(--color-primary)] transition-colors font-bold text-sm">Select</button>
                        </div>

                        <!-- Express -->
                        <div
                            class="bg-[#1C1E21] border border-[var(--color-valen-border)] rounded-2xl p-8 flex flex-col items-center text-center transition-all duration-300 hover:border-[var(--color-primary)] hover:shadow-[0_0_30px_rgba(163,5,10,0.15)] scale-105 z-10 shadow-2xl group relative overflow-hidden">
                            <div
                                class="absolute top-0 right-0 bg-[var(--color-primary)] text-white text-[10px] font-bold px-3 py-1 rounded-bl uppercase">
                                Most Popular</div>
                            <div
                                class="w-12 h-12 rounded-lg bg-[#2A1215] flex items-center justify-center text-[var(--color-primary)] mb-6">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">Express</h3>
                            <p class="text-xs text-gray-500 mb-6">Faster service for urgent needs</p>
                            <div class="text-4xl font-black text-[var(--color-primary)] mb-6">$25 <span
                                    class="text-sm font-medium text-gray-400">/ per card</span></div>
                            <div class="text-sm text-white font-bold mb-8">Turnaround: <span
                                    class="text-gray-400 font-normal">20 Business Days</span></div>

                            <ul class="text-sm text-gray-400 text-left space-y-3 mb-8 w-full">
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg> All Standard features</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg> Priority handling</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg> Enhanced insurance</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg> Front of line access</li>
                            </ul>
                            <button
                                class="mt-auto w-full py-3 rounded-lg border border-[var(--color-valen-border)] text-white hover:bg-[var(--color-primary)] hover:border-[var(--color-primary)] transition-colors font-bold text-sm">Select</button>
                        </div>

                        <!-- Elite -->
                        <div
                            class="bg-[#1C1E21] border border-[var(--color-valen-border)] rounded-2xl p-8 flex flex-col items-center text-center transition-all duration-300 hover:border-[var(--color-primary)] hover:shadow-[0_0_30px_rgba(163,5,10,0.15)] group relative overflow-hidden">
                            <div
                                class="w-12 h-12 rounded-lg bg-[#2A1215] flex items-center justify-center text-[var(--color-primary)] mb-6">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-2">Elite</h3>
                            <p class="text-xs text-gray-500 mb-6">Our Premium Service</p>
                            <div class="text-4xl font-black text-[var(--color-primary)] mb-6">$45 <span
                                    class="text-sm font-medium text-gray-400">/ per card</span></div>
                            <div class="text-sm text-white font-bold mb-8">Turnaround: <span class="text-gray-400 font-normal">5
                                    Business Days</span></div>

                            <ul class="text-sm text-gray-400 text-left space-y-3 mb-8 w-full">
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg> All Express features</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg> Same day processing</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg> Dedicated support</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg> Max insurance cover</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg> White glove service</li>
                            </ul>
                            <button
                                class="mt-auto w-full py-3 rounded-lg border border-[var(--color-valen-border)] text-white hover:bg-[var(--color-primary)] hover:border-[var(--color-primary)] transition-colors font-bold text-sm">Select</button>
                        </div>
                    </div>

                    <!-- Autograph Content -->
                    <div x-show="activeTab === 'autograph'" style="display: none;"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 translate-y-8"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-300 absolute top-0 w-full"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-8"
                         class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full">
                         <!-- Auto Standard -->
                        <div class="bg-[#1C1E21] border border-[var(--color-valen-border)] rounded-2xl p-8 flex flex-col items-center text-center transition-all duration-300 hover:border-[var(--color-primary)] hover:shadow-[0_0_30px_rgba(163,5,10,0.15)] group relative overflow-hidden">
                             <h3 class="text-xl font-bold text-white mb-2">Basic Auto</h3>
                             <p class="text-xs text-gray-500 mb-6">Authentication Only</p>
                             <div class="text-4xl font-black text-[var(--color-primary)] mb-6">$20 <span class="text-sm font-medium text-gray-400">/ item</span></div>
                             <div class="text-sm text-white font-bold mb-8">Turnaround: <span class="text-gray-400 font-normal">45 Business Days</span></div>
                             <ul class="text-sm text-gray-400 text-left space-y-3 mb-8 w-full">
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Signature verification</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Encapsulation</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Database entry</li>
                             </ul>
                             <button class="mt-auto w-full py-3 rounded-lg border border-[var(--color-valen-border)] text-white hover:bg-[var(--color-primary)] hover:border-[var(--color-primary)] transition-colors font-bold text-sm">Select</button>
                        </div>

                        <!-- Auto Express -->
                        <div class="bg-[#1C1E21] border border-[var(--color-valen-border)] rounded-2xl p-8 flex flex-col items-center text-center transition-all duration-300 hover:border-[var(--color-primary)] hover:shadow-[0_0_30px_rgba(163,5,10,0.15)] scale-105 z-10 shadow-2xl group relative overflow-hidden">
                             <div class="absolute top-0 right-0 bg-[var(--color-primary)] text-white text-[10px] font-bold px-3 py-1 rounded-bl uppercase">Most Popular</div>
                             <h3 class="text-xl font-bold text-white mb-2">Grade + Auto</h3>
                             <p class="text-xs text-gray-500 mb-6">Card Grade & Auto Auth</p>
                             <div class="text-4xl font-black text-[var(--color-primary)] mb-6">$35 <span class="text-sm font-medium text-gray-400">/ item</span></div>
                             <div class="text-sm text-white font-bold mb-8">Turnaround: <span class="text-gray-400 font-normal">20 Business Days</span></div>
                             <ul class="text-sm text-gray-400 text-left space-y-3 mb-8 w-full">
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Card Grading</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Auto Authentication</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Dual label info</li>
                             </ul>
                             <button class="mt-auto w-full py-3 rounded-lg border border-[var(--color-valen-border)] text-white hover:bg-[var(--color-primary)] hover:border-[var(--color-primary)] transition-colors font-bold text-sm">Select</button>
                        </div>

                        <!-- Auto Elite -->
                        <div class="bg-[#1C1E21] border border-[var(--color-valen-border)] rounded-2xl p-8 flex flex-col items-center text-center transition-all duration-300 hover:border-[var(--color-primary)] hover:shadow-[0_0_30px_rgba(163,5,10,0.15)] group relative overflow-hidden">
                             <h3 class="text-xl font-bold text-white mb-2">Dual Service</h3>
                             <p class="text-xs text-gray-500 mb-6">Grade Both Card & Auto</p>
                             <div class="text-4xl font-black text-[var(--color-primary)] mb-6">$55 <span class="text-sm font-medium text-gray-400">/ item</span></div>
                             <div class="text-sm text-white font-bold mb-8">Turnaround: <span class="text-gray-400 font-normal">5 Business Days</span></div>
                             <ul class="text-sm text-gray-400 text-left space-y-3 mb-8 w-full">
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Card Grading (1-10)</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Auto Grading (1-10)</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Detailed subgrades</li>
                             </ul>
                             <button class="mt-auto w-full py-3 rounded-lg border border-[var(--color-valen-border)] text-white hover:bg-[var(--color-primary)] hover:border-[var(--color-primary)] transition-colors font-bold text-sm">Select</button>
                        </div>
                    </div>

                    <!-- Reholder Content -->
                    <div x-show="activeTab === 'reholder'" style="display: none;"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 translate-y-8"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-300 absolute top-0 w-full"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-8"
                         class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full">
                         <!-- Reholder Standard -->
                        <div class="bg-[#1C1E21] border border-[var(--color-valen-border)] rounded-2xl p-8 flex flex-col items-center text-center transition-all duration-300 hover:border-[var(--color-primary)] hover:shadow-[0_0_30px_rgba(163,5,10,0.15)] group relative overflow-hidden">
                             <h3 class="text-xl font-bold text-white mb-2">Standard</h3>
                             <p class="text-xs text-gray-500 mb-6">Re-case Existing Slabs</p>
                             <div class="text-4xl font-black text-[var(--color-primary)] mb-6">$10 <span class="text-sm font-medium text-gray-400">/ card</span></div>
                             <div class="text-sm text-white font-bold mb-8">Turnaround: <span class="text-gray-400 font-normal">45 Business Days</span></div>
                             <ul class="text-sm text-gray-400 text-left space-y-3 mb-8 w-full">
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> New Generation Slab</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Label refresh</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Sonic sealing</li>
                             </ul>
                             <button class="mt-auto w-full py-3 rounded-lg border border-[var(--color-valen-border)] text-white hover:bg-[var(--color-primary)] hover:border-[var(--color-primary)] transition-colors font-bold text-sm">Select</button>
                        </div>

                        <!-- Reholder Express -->
                        <div class="bg-[#1C1E21] border border-[var(--color-valen-border)] rounded-2xl p-8 flex flex-col items-center text-center transition-all duration-300 hover:border-[var(--color-primary)] hover:shadow-[0_0_30px_rgba(163,5,10,0.15)] scale-105 z-10 shadow-2xl group relative overflow-hidden">
                             <div class="absolute top-0 right-0 bg-[var(--color-primary)] text-white text-[10px] font-bold px-3 py-1 rounded-bl uppercase">Most Popular</div>
                             <h3 class="text-xl font-bold text-white mb-2">Express</h3>
                             <p class="text-xs text-gray-500 mb-6">Fast Track Re-casing</p>
                             <div class="text-4xl font-black text-[var(--color-primary)] mb-6">$20 <span class="text-sm font-medium text-gray-400">/ card</span></div>
                             <div class="text-sm text-white font-bold mb-8">Turnaround: <span class="text-gray-400 font-normal">20 Business Days</span></div>
                             <ul class="text-sm text-gray-400 text-left space-y-3 mb-8 w-full">
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Priority queue</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> New Generation Slab</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Enhanced protection</li>
                             </ul>
                             <button class="mt-auto w-full py-3 rounded-lg border border-[var(--color-valen-border)] text-white hover:bg-[var(--color-primary)] hover:border-[var(--color-primary)] transition-colors font-bold text-sm">Select</button>
                        </div>

                        <!-- Reholder Elite -->
                        <div class="bg-[#1C1E21] border border-[var(--color-valen-border)] rounded-2xl p-8 flex flex-col items-center text-center transition-all duration-300 hover:border-[var(--color-primary)] hover:shadow-[0_0_30px_rgba(163,5,10,0.15)] group relative overflow-hidden">
                             <h3 class="text-xl font-bold text-white mb-2">Elite</h3>
                             <p class="text-xs text-gray-500 mb-6">Premium Re-casing</p>
                             <div class="text-4xl font-black text-[var(--color-primary)] mb-6">$35 <span class="text-sm font-medium text-gray-400">/ card</span></div>
                             <div class="text-sm text-white font-bold mb-8">Turnaround: <span class="text-gray-400 font-normal">5 Business Days</span></div>
                             <ul class="text-sm text-gray-400 text-left space-y-3 mb-8 w-full">
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Max Speed</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> UV Protection</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Custom label option</li>
                             </ul>
                             <button class="mt-auto w-full py-3 rounded-lg border border-[var(--color-valen-border)] text-white hover:bg-[var(--color-primary)] hover:border-[var(--color-primary)] transition-colors font-bold text-sm">Select</button>
                        </div>
                    </div>

                    <!-- Authentication Content -->
                    <div x-show="activeTab === 'authentication'" style="display: none;"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 translate-y-8"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-300 absolute top-0 w-full"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-8"
                         class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full">
                         <!-- Auth Standard -->
                        <div class="bg-[#1C1E21] border border-[var(--color-valen-border)] rounded-2xl p-8 flex flex-col items-center text-center transition-all duration-300 hover:border-[var(--color-primary)] hover:shadow-[0_0_30px_rgba(163,5,10,0.15)] group relative overflow-hidden">
                             <h3 class="text-xl font-bold text-white mb-2">Standard</h3>
                             <p class="text-xs text-gray-500 mb-6">Verification Only</p>
                             <div class="text-4xl font-black text-[var(--color-primary)] mb-6">$12 <span class="text-sm font-medium text-gray-400">/ item</span></div>
                             <div class="text-sm text-white font-bold mb-8">Turnaround: <span class="text-gray-400 font-normal">45 Business Days</span></div>
                             <ul class="text-sm text-gray-400 text-left space-y-3 mb-8 w-full">
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Visual inspection</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Digital Proof</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Database addition</li>
                             </ul>
                             <button class="mt-auto w-full py-3 rounded-lg border border-[var(--color-valen-border)] text-white hover:bg-[var(--color-primary)] hover:border-[var(--color-primary)] transition-colors font-bold text-sm">Select</button>
                        </div>

                        <!-- Auth Express -->
                        <div class="bg-[#1C1E21] border border-[var(--color-valen-border)] rounded-2xl p-8 flex flex-col items-center text-center transition-all duration-300 hover:border-[var(--color-primary)] hover:shadow-[0_0_30px_rgba(163,5,10,0.15)] scale-105 z-10 shadow-2xl group relative overflow-hidden">
                             <div class="absolute top-0 right-0 bg-[var(--color-primary)] text-white text-[10px] font-bold px-3 py-1 rounded-bl uppercase">Most Popular</div>
                             <h3 class="text-xl font-bold text-white mb-2">Express</h3>
                             <p class="text-xs text-gray-500 mb-6">Fast Verification</p>
                             <div class="text-4xl font-black text-[var(--color-primary)] mb-6">$22 <span class="text-sm font-medium text-gray-400">/ item</span></div>
                             <div class="text-sm text-white font-bold mb-8">Turnaround: <span class="text-gray-400 font-normal">20 Business Days</span></div>
                             <ul class="text-sm text-gray-400 text-left space-y-3 mb-8 w-full">
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Priority review</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Physical Letter</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Fast tracking</li>
                             </ul>
                             <button class="mt-auto w-full py-3 rounded-lg border border-[var(--color-valen-border)] text-white hover:bg-[var(--color-primary)] hover:border-[var(--color-primary)] transition-colors font-bold text-sm">Select</button>
                        </div>

                        <!-- Auth Elite -->
                        <div class="bg-[#1C1E21] border border-[var(--color-valen-border)] rounded-2xl p-8 flex flex-col items-center text-center transition-all duration-300 hover:border-[var(--color-primary)] hover:shadow-[0_0_30px_rgba(163,5,10,0.15)] group relative overflow-hidden">
                             <h3 class="text-xl font-bold text-white mb-2">Elite</h3>
                             <p class="text-xs text-gray-500 mb-6">Expert Verification</p>
                             <div class="text-4xl font-black text-[var(--color-primary)] mb-6">$40 <span class="text-sm font-medium text-gray-400">/ item</span></div>
                             <div class="text-sm text-white font-bold mb-8">Turnaround: <span class="text-gray-400 font-normal">5 Business Days</span></div>
                             <ul class="text-sm text-gray-400 text-left space-y-3 mb-8 w-full">
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Multi-expert panel</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> Detailed Report</li>
                                <li class="flex items-center"><svg class="w-3 h-3 text-[var(--color-primary)] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg> High value items</li>
                             </ul>
                             <button class="mt-auto w-full py-3 rounded-lg border border-[var(--color-valen-border)] text-white hover:bg-[var(--color-primary)] hover:border-[var(--color-primary)] transition-colors font-bold text-sm">Select</button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Feature Comparison -->
            <div class="mb-12">
                <div class="text-center mb-16">
                    <h2 class="text-2xl font-bold text-white mb-4">Feature Comparison</h2>
                    <p class="text-gray-400">See what's included with each service tier</p>
                </div>

                <div class="overflow-x-auto border border-[var(--color-valen-border)] rounded-2xl">
                    <table class="w-full text-sm text-left text-gray-400">
                        <thead class="text-xs text-white uppercase bg-black/40">
                            <tr>
                                <th scope="col" class="px-6 py-4 font-bold">Feature</th>
                                <th scope="col" class="px-6 py-4 font-bold text-center">Standard</th>
                                <th scope="col" class="px-6 py-4 font-bold text-center">Express</th>
                                <th scope="col" class="px-6 py-4 font-bold text-center">Elite</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[var(--color-valen-border)] bg-[#1C1E21]">
                            @foreach([
                                    'Industry-Leading AI' => [true, true, true],
                                    'Tamper-Evident Slab' => [true, true, true],
                                    'Digital Certificates' => [true, true, true],
                                    'Online Registry' => [true, true, true],
                                    'Priority Processing' => [false, true, true],
                                    'High-Res Imaging' => [false, true, true],
                                    'High-Value Insurance' => [false, true, true],
                                    'Same-Day Turnaround' => [false, false, true],
                                    'Dedicated AM' => [false, false, true],
                                    'Personal Account Manager' => [false, false, true],
                                    'White Glove Service' => [false, false, true],
                                ] as $feature => $tiers)




                                                                <tr class="hover:bg-white/5 transition-colors">




                                                                        <td class="px-6 py-4 font-medium text-white">{{ $feature }}</td>
                                    <td class="px-6 py-4 text-center">
                                        @if($tiers[0]) <svg class="w-4 h-4 text-[var(--color-primary)] mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        @else <svg class="w-4 h-4 text-gray-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> @endif
                                     </td>
                                     <td class="px-6 py-4 text-center">
                                         @if($tiers[1]) <svg class="w-4 h-4 text-[var(--color-primary)] mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                         @else <svg class="w-4 h-4 text-gray-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> @endif
                                     </td>
                                     <td class="px-6 py-4 text-center">
                                             @if($tiers[2]) <svg class="w-4 h-4 text-[var(--color-primary)] mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                             @else <svg class="w-4 h-4 text-gray-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> @endif
                                         </td>
                                     </tr>
                             @endforeach
                             </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
@endsection
