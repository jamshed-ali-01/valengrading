        <header id="site-header" class="bg-[var(--color-valen-dark)] border-b border-[var(--color-valen-border)] sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center  ">
                        <a href="{{ route('home') }}" class="flex items-center  ">
                            <div
                                class="size-12 bg-[var(--color-primary)] rounded-xl flex items-center justify-center p-2  shadow-[0_0_20px_rgba(163,5,10,0.4)]">
                                <img src="{{ asset('images/logo.avif') }}" class="h-full  w-full" alt="">
                            </div>
                        </a>
                    </div>

                    <!-- Desktop Navigation (Centered) -->
                    <nav class="hidden md:flex space-x-8">
                        <a href="{{ route('home') }}"
                            class="px-3 py-2 text-sm font-medium transition-colors {{ Route::is('home') ? 'text-[var(--color-primary)]' : 'text-gray-300 hover:text-white' }}">Home</a>
                        <a href="{{ route('about') }}"
                            class="px-3 py-2 text-sm font-medium transition-colors {{ Route::is('about') ? 'text-[var(--color-primary)]' : 'text-gray-300 hover:text-white' }}">About</a>
                        <a href="{{ route('faq') }}"
                            class="px-3 py-2 text-sm font-medium transition-colors {{ Route::is('faq') ? 'text-[var(--color-primary)]' : 'text-gray-300 hover:text-white' }}">FAQs</a>
                        <a href="{{ route('contact') }}"
                            class="px-3 py-2 text-sm font-medium transition-colors {{ Route::is('contact') ? 'text-[var(--color-primary)]' : 'text-gray-300 hover:text-white' }}">Contact</a>
                        <a href="{{ route('pricing') }}"
                            class="px-3 py-2 text-sm font-medium transition-colors {{ Route::is('pricing') ? 'text-[var(--color-primary)]' : 'text-gray-300 hover:text-white' }}">Pricing</a>



                        <div class="relative group" x-data="{ open: false }" @click.away="open = false">
                            <button @click="open = !open"
                                class="flex items-center px-3 py-2 text-sm font-medium transition-colors {{ Route::is('pop-report') ? 'text-[var(--color-primary)]' : 'text-gray-300 hover:text-white' }}">
                                Reports
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" x-transition
                                class="absolute top-full left-0 mt-2 w-48 rounded-md shadow-lg bg-[#1C1E21] border border-[var(--color-valen-border)] z-50">
                                <a href="{{ route('pop-report') }}"
                                    class="block px-4 py-2 text-sm text-gray-400 hover:text-white hover:bg-black/20">Pop
                                    Report</a>
                            </div>
                        </div>
                    </nav>

                    <!-- User Actions -->
                    <div class="flex items-center space-x-6">
                        @auth
                            <div class="hidden md:flex items-center gap-6">
                                <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard') }}"
                                    class="text-white text-sm font-medium hover:text-[var(--color-primary)] transition-colors">
                                    Dashboard
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="text-white text-sm font-medium hover:text-[var(--color-primary)] transition-colors">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}"
                                class="hidden md:block text-white text-sm font-medium hover:text-[var(--color-primary)] transition-colors">
                                Sign In
                            </a>
                        @endauth

                        <a href="{{ route('submission.step1') }}"
                            class="bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] text-white px-5 py-2.5 rounded-xl text-sm font-semibold transition-colors shadow-[0_4px_14px_0_rgba(163,5,10,0.3)] uppercase tracking-wide">
                            Submit Cards
                        </a>

                        <!-- Mobile menu button -->
                        <div class="flex md:hidden">
                            <button @click="mobileMenuOpen = !mobileMenuOpen"
                                class="text-gray-400 hover:text-white focus:outline-none">
                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div x-show="mobileMenuOpen" x-collapse
                class="md:hidden bg-[#1C1E21] border-b border-[var(--color-valen-border)]">
                <div class="px-4 pt-2 pb-6 space-y-1">
                    <a href="{{ route('home') }}"
                        class="block px-3 py-4 text-base font-medium {{ Route::is('home') ? 'text-[var(--color-primary)]' : 'text-gray-300' }}">Home</a>
                    <a href="{{ route('pricing') }}"
                        class="block px-3 py-4 text-base font-medium {{ Route::is('pricing') ? 'text-[var(--color-primary)]' : 'text-gray-300' }}">Pricing</a>
                    <a href="{{ route('faq') }}"
                        class="block px-3 py-4 text-base font-medium {{ Route::is('faq') ? 'text-[var(--color-primary)]' : 'text-gray-300' }}">FAQs</a>
                    <a href="{{ route('contact') }}"
                        class="block px-3 py-4 text-base font-medium {{ Route::is('contact') ? 'text-[var(--color-primary)]' : 'text-gray-300' }}">Contact</a>
                    <a href="{{ route('pop-report') }}"
                        class="block px-3 py-4 text-base font-medium {{ Route::is('pop-report') ? 'text-[var(--color-primary)]' : 'text-gray-300' }}">Pop
                        Report</a>
                    <div class="pt-4 flex flex-col gap-4">
                        @auth
                            <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard') }}"
                                class="text-center py-3 text-white font-medium border border-[var(--color-valen-border)] rounded">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-center py-3 text-white font-medium border border-[var(--color-valen-border)] rounded">Log
                                in</a>
                        @endauth
                    </div>
                </div>
            </div>
        </header>
