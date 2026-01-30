        <footer class="bg-[var(--color-valen-dark)] border-t border-[var(--color-valen-border)] mt-auto py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8">
                    <div class="col-span-1">
                        <div class="flex items-center gap-2 mb-6">
                            <div
                                class="w-8 h-8 bg-[var(--color-primary)] rounded flex items-center justify-center text-white font-bold">
                                V</div>
                            <div class="flex flex-col">
                                <span class="text-white font-bold text-lg leading-none tracking-wider">VALEN</span>
                                <span
                                    class="text-white text-[10px] uppercase tracking-[0.2em] leading-none">Grading</span>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 leading-relaxed max-w-xs">
                            Professional trading card grading services with industry-leading quality standards and
                            rigorous authentication.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-6">Services</h3>
                        <ul class="space-y-4">
                            <li><a href="{{ route('pricing') }}"
                                    class="text-xs text-gray-500 hover:text-white transition-colors">Pricing</a></li>
                            <li><a href="{{ route('pricing') }}"
                                    class="text-xs text-gray-500 hover:text-white transition-colors">Service Levels</a>
                            </li>
                            <li><a href="{{ route('submission.step1') }}"
                                    class="text-xs text-gray-500 hover:text-white transition-colors">Submit Cards</a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-6">Supports</h3>
                        <ul class="space-y-4">
                            <li><a href="{{ route('about') }}"
                                    class="text-xs text-gray-500 hover:text-white transition-colors">About
                                    Us</a></li>
                            <li><a href="{{ route('faq') }}"
                                    class="text-xs text-gray-500 hover:text-white transition-colors">FAQs</a></li>
                            <li><a href="{{ route('contact') }}"
                                    class="text-xs text-gray-500 hover:text-white transition-colors">Contact Us</a></li>
                        </ul>
                    </div>

                    <div class="flex flex-col" x-data="newsletterForm()">
                        <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-6">Newsletter</h3>
                        <form @submit.prevent="submit" class="flex flex-col gap-2">
                            <div class="flex">
                                <input type="email" x-model="email" placeholder="Enter your email" required
                                    class="bg-[#1C1E21] border border-[var(--color-valen-border)] border-r-0 rounded-l px-4 py-2.5 text-xs w-full focus:ring-0 focus:border-[var(--color-primary)] outline-none text-white">
                                <button type="submit" :disabled="loading"
                                    class="bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] px-6 py-2.5 rounded-r text-xs font-bold uppercase tracking-wider transition-colors text-white disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span x-show="!loading">Join</span>
                                    <span x-show="loading" class="animate-pulse">...</span>
                                </button>
                            </div>
                            <p x-show="message" x-text="message" :class="status === 'success' ? 'text-green-500' : 'text-red-500'" class="text-xs mt-1" style="display: none;"></p>
                        </form>
                    </div>

                    <script>
                        function newsletterForm() {
                            return {
                                email: '',
                                loading: false,
                                message: '',
                                status: '',
                                submit() {
                                    this.loading = true;
                                    this.message = '';
                                    
                                    fetch('{{ route('newsletter.subscribe') }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({ email: this.email })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        this.status = data.status || 'error';
                                        this.message = data.message || 'Error occurred';
                                        if(this.status === 'success') {
                                            this.email = '';
                                            setTimeout(() => { this.message = ''; }, 5000);
                                        }
                                    })
                                    .catch(error => {
                                        console.error(error);
                                        this.status = 'error';
                                        this.message = 'Something went wrong. Please try again.';
                                    })
                                    .finally(() => {
                                        this.loading = false;
                                    });
                                }
                            }
                        }
                    </script>
                </div>
                <div
                    class="mt-16 pt-8 border-t border-[var(--color-valen-border)] flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-xs text-gray-600">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                    <div class="flex gap-8">
                        <!-- <a href="#" class="text-xs text-gray-600 hover:text-white transition-colors">Privacy Policy</a>
                        <a href="#" class="text-xs text-gray-600 hover:text-white transition-colors">Terms of
                            Service</a> -->
                    </div>
                </div>
            </div>
        </footer>
