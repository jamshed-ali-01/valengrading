@extends('layouts.frontend')

@section('content')
    <div class="bg-[var(--color-valen-dark)] min-h-screen py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h1 class="text-4xl font-extrabold text-white sm:text-5xl mb-4">Contact Us</h1>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">Have questions about our grading services? We're here to
                    help you get started.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-[var(--color-valen-dark)] border border-[var(--color-valen-border)] rounded-2xl p-8 sm:p-10">
                    <h2 class="text-2xl font-bold text-white mb-8">Send Us a Message</h2>
                    
                    @if(session('success'))
                        <div class="mb-6 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-4 py-3 rounded-xl flex items-center gap-3">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-xl">
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-xs font-medium text-gray-400 mb-2">Name</label>
                                <input type="text" name="name" id="name"
                                    class="block w-full bg-[#1C1E21] border border-[var(--color-valen-border)] rounded-lg text-white px-4 py-3 text-sm focus:ring-[var(--color-primary)] focus:border-[var(--color-primary)] placeholder-gray-600"
                                    placeholder="Name">
                            </div>
                            <div>
                                <label for="email" class="block text-xs font-medium text-gray-400 mb-2">Email *</label>
                                <input type="email" name="email" id="email" required
                                    class="block w-full bg-[#1C1E21] border border-[var(--color-valen-border)] rounded-lg text-white px-4 py-3 text-sm focus:ring-[var(--color-primary)] focus:border-[var(--color-primary)] placeholder-gray-600"
                                    placeholder="Email">
                            </div>
                        </div>
                        <div>
                            <label for="subject" class="block text-xs font-medium text-gray-400 mb-2">Subject</label>
                            <input type="text" name="subject" id="subject"
                                class="block w-full bg-[#1C1E21] border border-[var(--color-valen-border)] rounded-lg text-white px-4 py-3 text-sm focus:ring-[var(--color-primary)] focus:border-[var(--color-primary)] placeholder-gray-600">
                        </div>
                        <div>
                            <label for="message" class="block text-xs font-medium text-gray-400 mb-2">Message *</label>
                            <textarea name="message" id="message" rows="4" required
                                class="block w-full bg-[#1C1E21] border border-[var(--color-valen-border)] rounded-lg text-white px-4 py-3 text-sm focus:ring-[var(--color-primary)] focus:border-[var(--color-primary)] placeholder-gray-600"
                                placeholder="Message"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-[var(--color-primary)] text-white font-bold py-4 rounded-lg hover:bg-[var(--color-primary-hover)] transition-colors shadow-lg">
                            Send Message
                        </button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div
                    class="bg-[#1C1E21] border border-[var(--color-valen-border)] rounded-2xl p-8 sm:p-10 flex flex-col justify-center space-y-6">
                    <h2 class="text-2xl font-bold text-white mb-10">Get in Touch</h2>
                    <!-- Address -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 rounded-xl bg-primary/20 flex items-center justify-center text-[var(--color-primary)]">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-6">
                            <h3 class="text-lg font-bold text-white">Address</h3>
                            <p class="mt-1 text-sm text-gray-400">1234 Grading Street</p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 rounded-xl bg-primary/20 flex items-center justify-center text-[var(--color-primary)]">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-6">
                            <h3 class="text-lg font-bold text-white">Phone</h3>
                            <p class="mt-1 text-sm text-gray-400">(555) 123-GRADE</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 rounded-xl bg-primary/20 flex items-center justify-center text-[var(--color-primary)]">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-6">
                            <h3 class="text-lg font-bold text-white">Email</h3>
                            <p class="mt-1 text-sm text-gray-400">support@valengrading.com</p>
                        </div>
                    </div>

                    <!-- Hours -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <div
                                class="w-12 h-12 rounded-xl bg-primary/20 flex items-center justify-center text-[var(--color-primary)]">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-6">
                            <h3 class="text-lg font-bold text-white">Business Hour</h3>
                            <p class="mt-1 text-sm text-gray-400">Monday - Friday: 8:00 AM - 6:00 PM PST</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection