@extends('layouts.frontend')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-[var(--color-valen-dark)] pt-20 pb-16 sm:pt-32 sm:pb-32 overflow-hidden">
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
            <div class="flex justify-center mb-8">
                <!-- Logo mark -->
                <div class="flex flex-col items-center animate-fade-in">
                    <div
                        class="size-12 bg-[var(--color-primary)] rounded-xl flex items-center justify-center mb-4 p-2 shadow-[0_0_20px_rgba(163,5,10,0.4)]">
                        <img src="{{ asset('images/logo.avif') }}" class="h-full  w-full" alt="">
                         
                    </div>
                </div>
            </div>
            <h1 class="text-5xl tracking-tight font-extrabold text-white sm:text-6xl md:text-7xl mb-6 animate-slide-up">
                Precision Card
            </h1>
            <p class="mt-6 max-w-2xl mx-auto text-xl text-gray-400 mb-12 animate-slide-up" style="animation-delay: 0.1s;">
                Premium UK-based card grading <br> for collectors who demand excellence.
            </p>
            <div class="flex justify-center flex-col sm:flex-row gap-4 animate-slide-up" style="animation-delay: 0.2s;">
                <a href="{{ route('submission.step1') }}"
                    class="inline-flex items-center justify-center px-10 py-4 border border-transparent text-base font-bold rounded-xl text-white bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] transition-all duration-300 shadow-[0_0_20px_rgba(163,5,10,0.4)] hover:shadow-[0_0_30px_rgba(163,5,10,0.6)] hover:-translate-y-1 uppercase tracking-wider">
                    Submit Cards Now
                </a>
            </div>
            <a href="#labelOptionSection"
                class="mt-6 inline-block text-xs text-white/70 uppercase  font-semibold tracking-widest animate-slide-up"
                style="animation-delay: 0.3s;">
                See Label options</a>
        </div>

        <!-- Abstract Background Glow -->
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-[var(--color-primary)] rounded-full mix-blend-screen filter blur-[150px] opacity-10 pointer-events-none">
        </div>
    </div>

    <!-- Infinite Card Slider -->
    <div class="bg-[#0A0C0E] border-y border-[var(--color-valen-border)] overflow-hidden py-10 relative">
        <div class="absolute inset-y-0 left-0 w-32 bg-gradient-to-r from-[#0A0C0E] to-transparent z-10"></div>
        <div class="absolute inset-y-0 right-0 w-32 bg-gradient-to-l from-[#0A0C0E] to-transparent z-10"></div>

        <div class="flex w-[200%] animate-marquee">
            <!-- First set of cards -->
            <div class="flex justify-around w-1/2 px-4 gap-8">
                @foreach($showcaseCards as $card)
                    <div
                        class="flex-shrink-0 w-48 h-72 bg-[var(--color-valen-light)] rounded-lg border-2 border-[#333] relative group shadow-2xl skew-x-[-2deg] transform transition-transform hover:scale-110 hover:z-20 hover:border-[var(--color-primary)]">
                        <div
                            class="absolute top-2 right-2 w-8 h-8 rounded-full bg-[var(--color-primary)] text-white flex items-center justify-center font-bold text-xs border border-white/20 shadow-lg">
                            {{ $card->grade }}</div>
                        <div class="absolute inset-2 bg-[#1a1d21] rounded flex items-center justify-center overflow-hidden"> 
                          <img src="{{ asset($card->image_path) }}" class="h-full w-full object-cover" alt="{{ $card->title }}">
                             
                        </div>
                        
                    </div>
                @endforeach
                @foreach($showcaseCards as $card)
                    <div
                        class="flex-shrink-0 w-48 h-72 bg-[var(--color-valen-light)] rounded-lg border-2 border-[#333] relative group shadow-2xl skew-x-[-2deg] transform transition-transform hover:scale-110 hover:z-20 hover:border-[var(--color-primary)]">
                        <div class="absolute inset-2 bg-[#1a1d21] rounded flex items-center justify-center overflow-hidden">
                          <img src="{{ asset($card->image_path) }}" class="h-full w-full object-cover" alt="{{ $card->title }}">
                             
                        </div>
                        
                    </div>
                @endforeach
            </div>
             
        </div>
    </div>

    <!-- Features Section (Expanded) -->
    <div class="py-24 bg-[var(--color-valen-dark)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
                <!-- Feature 1 -->
                <div class="flex flex-col items-center text-center group">
                    <div
                        class="h-16 w-16 bg-[#1C1E21] rounded-xl flex items-center justify-center mb-6 group-hover:bg-[var(--color-primary)]/10 transition-colors duration-300 border border-[var(--color-valen-border)] group-hover:border-[var(--color-primary)]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-8 h-8 text-[var(--color-primary)]">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-3">Very Fast Turnaround</h3>
                    <p class="text-sm text-gray-500 leading-relaxed max-w-xs">
                        Industry-leading turnaround times without compromising quality. We value your time.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="flex flex-col items-center text-center group">
                    <div
                        class="h-16 w-16 bg-[#1C1E21] rounded-xl flex items-center justify-center mb-6 group-hover:bg-[var(--color-primary)]/10 transition-colors duration-300 border border-[var(--color-valen-border)] group-hover:border-[var(--color-primary)]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-8 h-8 text-[var(--color-primary)]">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-3">Guaranteed for Every Card</h3>
                    <p class="text-sm text-gray-500 leading-relaxed max-w-xs">
                        Every submission is backed by our comprehensive guarantee of authenticity and grade.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="flex flex-col items-center text-center group">
                    <div
                        class="h-16 w-16 bg-[#1C1E21] rounded-xl flex items-center justify-center mb-6 group-hover:bg-[var(--color-primary)]/10 transition-colors duration-300 border border-[var(--color-valen-border)] group-hover:border-[var(--color-primary)]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-8 h-8 text-[var(--color-primary)]">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-3">Easy Submission</h3>
                    <p class="text-sm text-gray-500 leading-relaxed max-w-xs">
                        Simple, streamlined online submission process designed for collectors.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="flex flex-col items-center text-center group">
                    <div
                        class="h-16 w-16 bg-[#1C1E21] rounded-xl flex items-center justify-center mb-6 group-hover:bg-[var(--color-primary)]/10 transition-colors duration-300 border border-[var(--color-valen-border)] group-hover:border-[var(--color-primary)]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-8 h-8 text-[var(--color-primary)]">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-3">Transparency & Safety</h3>
                    <p class="text-sm text-gray-500 leading-relaxed max-w-xs">
                        Full tracking and high-resolution imaging for complete peace of mind.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="flex flex-col items-center text-center group">
                    <div
                        class="h-16 w-16 bg-[#1C1E21] rounded-xl flex items-center justify-center mb-6 group-hover:bg-[var(--color-primary)]/10 transition-colors duration-300 border border-[var(--color-valen-border)] group-hover:border-[var(--color-primary)]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-8 h-8 text-[var(--color-primary)]">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-3">Custom Labeling</h3>
                    <p class="text-sm text-gray-500 leading-relaxed max-w-xs">
                        Personalize your slabs with our premium and custom label options.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="flex flex-col items-center text-center group">
                    <div
                        class="h-16 w-16 bg-[#1C1E21] rounded-xl flex items-center justify-center mb-6 group-hover:bg-[var(--color-primary)]/10 transition-colors duration-300 border border-[var(--color-valen-border)] group-hover:border-[var(--color-primary)]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-8 h-8 text-[var(--color-primary)]">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-3">Quality Control Expert</h3>
                    <p class="text-sm text-gray-500 leading-relaxed max-w-xs">
                        Rigorous multi-stage inspection by senior grading professionals.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Label Options Section -->
    <div id="labelOptionSection" class="py-24 bg-[#0A0C0E] border-y border-[var(--color-valen-border)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-extrabold text-white mb-4">Label Options</h2>
                <p class="text-gray-500 max-w-2xl mx-auto text-lg">
                    Choose from our range of label designs aimed to complement your card's aesthetic.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-5xl mx-auto">
                <!-- Option 1 -->
                <div
                    class="bg-[#1C1E21] rounded-2xl border border-[var(--color-valen-border)] p-10 text-center hover:border-[var(--color-primary)] hover:shadow-[0_0_30px_rgba(163,5,10,0.1)] transition-all duration-300 group">
                    <h3
                        class="text-lg font-bold text-[var(--color-primary)] mb-8 uppercase tracking-widest border-b border-[#333] pb-4 mx-auto w-1/2 group-hover:border-[var(--color-primary)] transition-colors">
                        Classic</h3>

                    <h4 class="text-xl font-bold text-white mb-2">Classic Label</h4>
                    <p class="text-sm text-gray-500 mb-6 leading-relaxed">
                        Traditional design offering a clean, timeless look for any collection.
                    </p>
                </div>

                <!-- Option 2 -->
                <div
                    class="bg-[#1C1E21] rounded-2xl border border-[var(--color-valen-border)] p-10 text-center hover:border-[var(--color-primary)] hover:shadow-[0_0_30px_rgba(163,5,10,0.2)] transition-all duration-300 relative transform md:-translate-y-4">
                    <div
                        class="absolute -top-3 left-1/2 -translate-x-1/2 bg-[var(--color-primary)] text-white text-[10px] font-bold px-4 py-1 rounded-full uppercase tracking-wider shadow-lg">
                        Most Popular</div>

                    <h3
                        class="text-lg font-bold text-[var(--color-primary)] mb-8 uppercase tracking-widest border-b border-[#333] pb-4 mx-auto w-1/2">
                        Premier</h3>

                    <h4 class="text-xl font-bold text-white mb-2">Premier Label</h4>
                    <p class="text-sm text-gray-500 mb-6 leading-relaxed">
                        Feature-rich design with enhanced security and premium aesthetics.
                    </p>
                </div>

                <!-- Option 3 -->
                <div
                    class="bg-[#1C1E21] rounded-2xl border border-[var(--color-valen-border)] p-10 text-center hover:border-[var(--color-primary)] hover:shadow-[0_0_30px_rgba(163,5,10,0.1)] transition-all duration-300 group">
                    <h3
                        class="text-lg font-bold text-[var(--color-primary)] mb-8 uppercase tracking-widest border-b border-[#333] pb-4 mx-auto w-1/2 group-hover:border-[var(--color-primary)] transition-colors">
                        Custom</h3>

                    <h4 class="text-xl font-bold text-white mb-2">Custom Label</h4>
                    <p class="text-sm text-gray-500 mb-6 leading-relaxed">
                        Fully bespoke designs for rare, special edition, or personal cards.
                    </p>
                </div>
            </div>
            <div class="text-center mt-16">
                <a href="{{ route('submission.step1') }}"
                    class="inline-flex items-center px-8 py-3 bg-[var(--color-primary)] text-white text-sm font-bold rounded-xl hover:bg-[var(--color-primary-hover)] transition-all duration-300 shadow-lg">
                    Start Submission
                </a>
            </div>
        </div>
    </div>

    <!-- Grading Process Section -->
    <div class="py-24 bg-[var(--color-valen-dark)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-extrabold text-white mb-4">Our Grading Process</h2>
                <p class="text-gray-500 max-w-2xl mx-auto text-lg hover:text-white transition-colors duration-300">
                    Transparent, secure, and professional handling from start to finish.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-8">
                <!-- Step 1 -->
                <div
                    class="bg-[#1C1E21] p-8 rounded-xl text-center border border-transparent hover:border-[var(--color-valen-border)] transition-all duration-300 group hover:-translate-y-1">
                    <div
                        class="w-12 h-12 mx-auto mb-6 flex items-center justify-center bg-[#0A0C0E] rounded-xl text-[var(--color-primary)] group-hover:bg-[var(--color-primary)] group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                    </div>
                    <h4 class="text-sm font-bold text-white mb-2">Submit & Ship</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">Prepare instructions online and mail us your cards.</p>
                </div>

                <!-- Step 2 -->
                <div
                    class="bg-[#1C1E21] p-8 rounded-xl text-center border border-transparent hover:border-[var(--color-valen-border)] transition-all duration-300 group hover:-translate-y-1">
                    <div
                        class="w-12 h-12 mx-auto mb-6 flex items-center justify-center bg-[#0A0C0E] rounded-xl text-[var(--color-primary)] group-hover:bg-[var(--color-primary)] group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <h4 class="text-sm font-bold text-white mb-2">Authentication</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">Cards are logged and verified upon arrival.</p>
                </div>

                <!-- Step 3 -->
                <div
                    class="bg-[#1C1E21] p-8 rounded-xl text-center border border-transparent hover:border-[var(--color-valen-border)] transition-all duration-300 group hover:-translate-y-1">
                    <div
                        class="w-12 h-12 mx-auto mb-6 flex items-center justify-center bg-[#0A0C0E] rounded-xl text-[var(--color-primary)] group-hover:bg-[var(--color-primary)] group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                        </svg>
                    </div>
                    <h4 class="text-sm font-bold text-white mb-2">Grading</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">Experts assess condition using advanced equipment.</p>
                </div>

                <!-- Step 4 -->
                <div
                    class="bg-[#1C1E21] p-8 rounded-xl text-center border border-transparent hover:border-[var(--color-valen-border)] transition-all duration-300 group hover:-translate-y-1">
                    <div
                        class="w-12 h-12 mx-auto mb-6 flex items-center justify-center bg-[#0A0C0E] rounded-xl text-[var(--color-primary)] group-hover:bg-[var(--color-primary)] group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                        </svg>
                    </div>
                    <h4 class="text-sm font-bold text-white mb-2">Encapsulation</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">Sonic welding seals the card in a protective slab.</p>
                </div>

                <!-- Step 5 -->
                <div
                    class="bg-[#1C1E21] p-8 rounded-xl text-center border border-transparent hover:border-[var(--color-valen-border)] transition-all duration-300 group hover:-translate-y-1">
                    <div
                        class="w-12 h-12 mx-auto mb-6 flex items-center justify-center bg-[#0A0C0E] rounded-xl text-[var(--color-primary)] group-hover:bg-[var(--color-primary)] group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125V14.25m-17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125V14.25m-17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125V14.25m-17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125V14.25M16.5 7.5V12.75a3 7.5 7.5 0 00-3 7.5h-3a7.5 7.5 0 00-3-7.5V7.5m9 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25V7.5m7.5 0H7.5" />
                        </svg>
                    </div>
                    <h4 class="text-sm font-bold text-white mb-2">Return Shipping</h4>
                    <p class="text-xs text-gray-500 leading-relaxed">Secure shipping with tracking to your doorstep.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="py-24 bg-[#0A0C0E] border-t border-[var(--color-valen-border)]">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-white mb-4">Frequently Asked Questions</h2>
                <p class="text-gray-500">
                    Quick answers to common questions about our grading services.
                </p>
            </div>

            <div class="space-y-4" x-data="{ active: null }">
                @foreach($faqs as $faq)
                <div class="bg-[#1C1E21] rounded-lg border border-[var(--color-valen-border)] overflow-hidden">
                    <button @click="active = (active === {{ $faq->id }} ? null : {{ $faq->id }})"
                        class="w-full px-6 py-5 text-left flex justify-between items-center focus:outline-none hover:bg-[var(--color-valen-dark)] transition-colors">
                        <span class="text-sm font-bold text-white">{{ $faq->question }}</span>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200"
                            :class="{'rotate-180': active === {{ $faq->id }}}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div x-show="active === {{ $faq->id }}" x-collapse style="display: none;">
                        <div class="px-6 pb-5 text-sm text-gray-400 leading-relaxed border-t border-gray-800 pt-4">
                            {{ $faq->answer }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection