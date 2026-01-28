@extends('layouts.frontend')

@section('content')
    <div class="bg-[var(--color-valen-dark)] min-h-screen py-24 sm:py-32 font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Our Story Section -->
            <div class="text-center mb-20 md:mb-28">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 tracking-tight">Our Story</h1>
                <p class="text-gray-400 max-w-2xl mx-auto text-lg leading-relaxed">
                    Founded on the principles of precision, trust, and excellence in trading card authentication.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-center mb-32 md:mb-48">
                <div class="animate-fade-in">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6 leading-tight">Building Trust <br> Through
                        Precision</h2>
                    <div class="space-y-6 text-gray-400 leading-relaxed text-base">
                        <p>
                            Valen Grading was established in 2019 with a singular mission: to provide collectors with the
                            most accurate and trustworthy card grading services in the industry. Our founders recognized the
                            need for a grading company that combined cutting-edge technology with traditional craftsmanship.
                        </p>
                        <p>
                            From our state-of-the-art facility, we've graded over 500,000 cards for collectors worldwide,
                            establishing ourselves as a trusted name in the trading card community.
                        </p>
                    </div>
                </div>

                <div
                    class="bg-[#181A1D] rounded-2xl p-8 md:p-12 border border-[var(--color-valen-border)] shadow-2xl animate-slide-up relative overflow-hidden">
                    <div class="space-y-4 relative z-10">
                        <!-- Item 1 -->
                        <div class="flex items-start gap-5 group">
                            <div class="shrink-0">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-[var(--color-primary)]/10 flex items-center justify-center text-[var(--color-primary)]">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-white font-bold mb-1 text-base">Security First</h3>
                                <p class="text-gray-500 text-sm leading-relaxed">Every card fully insured and tracked</p>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class=" border-[var(--color-valen-border)] pt-8 flex items-start gap-5 group">
                            <div class="shrink-0">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-[var(--color-primary)]/10 flex items-center justify-center text-[var(--color-primary)]">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-white font-bold mb-1 text-base">Expert Team</h3>
                                <p class="text-gray-500 text-sm leading-relaxed">Certified graders with decades of
                                    experience</p>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="  border-[var(--color-valen-border)] pt-8 flex items-start gap-5 group">
                            <div class="shrink-0">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-[var(--color-primary)]/10 flex items-center justify-center text-[var(--color-primary)]">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-white font-bold mb-1 text-base">Community Focused</h3>
                                <p class="text-gray-500 text-sm leading-relaxed">Supporting collectors at every level</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Our Vision Section -->
            <div class="text-center mb-32 md:mb-48 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-10">Our Vision</h2>
                <div class="max-w-4xl mx-auto px-6">
                    <p class="text-gray-400 text-xl md:text-2xl leading-relaxed text-center font-normal">
                        To be the world's most trusted trading card grading service, setting the standard for accuracy,
                        consistency, and customer satisfaction in the collectibles industry.
                    </p>
                </div>
            </div>

            <!-- Why Choose Valen Section -->
            <div class="mb-32">
                <div class="text-center mb-20 animate-fade-in">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 tracking-tight">Why Choose Valen?</h2>
                    <p class="text-gray-400 max-w-2xl mx-auto text-lg">
                        Experience the difference that expertise, precision, and dedication make in card grading.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-5xl mx-auto">
                    <!-- Column 1 -->
                    <div
                        class="bg-[#181A1D] border border-[var(--color-valen-border)] rounded-2xl p-12 text-center group h-full flex flex-col items-center justify-center hover:border-[var(--color-primary)]/30 transition-colors">
                        <div
                            class="w-14 h-14 bg-[var(--color-primary)]/10 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-[var(--color-primary)]" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-4">Trusted Authentication</h3>
                        <p class="text-gray-500 text-sm leading-relaxed max-w-xs mx-auto">
                            Our expert team uses advanced technology and decades of experience to authenticate every card
                            with absolute precision.
                        </p>
                    </div>

                    <!-- Column 2 -->
                    <div
                        class="bg-[#181A1D] border border-[var(--color-valen-border)] rounded-2xl p-12 text-center group h-full flex flex-col items-center justify-center hover:border-[var(--color-primary)]/30 transition-colors">
                        <div
                            class="w-14 h-14 bg-[var(--color-primary)]/10 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-[var(--color-primary)]" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-4">Industry-Leading Standards</h3>
                        <p class="text-gray-500 text-sm leading-relaxed max-w-xs mx-auto">
                            We maintain the highest grading standards in the industry, ensuring consistent and accurate
                            assessments.
                        </p>
                    </div>

                    <!-- Column 3 -->
                    <div
                        class="bg-[#181A1D] border border-[var(--color-valen-border)] rounded-2xl p-12 text-center group h-full flex flex-col items-center justify-center hover:border-[var(--color-primary)]/30 transition-colors">
                        <div
                            class="w-14 h-14 bg-[var(--color-primary)]/10 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-[var(--color-primary)]" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-4">Fast Turnaround</h3>
                        <p class="text-gray-500 text-sm leading-relaxed max-w-xs mx-auto">
                            Multiple service levels available to meet your timeline needs, from standard to premium rush
                            service.
                        </p>
                    </div>

                    <!-- Column 4 -->
                    <div
                        class="bg-[#181A1D] border border-[var(--color-valen-border)] rounded-2xl p-12 text-center group h-full flex flex-col items-center justify-center hover:border-[var(--color-primary)]/30 transition-colors">
                        <div
                            class="w-14 h-14 bg-[var(--color-primary)]/10 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-[var(--color-primary)]" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-4">Customer-First Approach</h3>
                        <p class="text-gray-500 text-sm leading-relaxed max-w-xs mx-auto">
                            Dedicated support team and transparent process updates keep you informed every step of the way.
                        </p>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="text-center animate-fade-in pb-12">
                <a href="{{ route('submission.step1') }}"
                    class="inline-block px-12 py-4 text-base font-bold rounded-xl text-white bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] transition-colors shadow-lg uppercase tracking-wide">
                    Submit Cards Now
                </a>
            </div>
        </div>
    </div>
@endsection