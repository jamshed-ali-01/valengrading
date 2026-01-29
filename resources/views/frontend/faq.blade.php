@extends('layouts.frontend')

@section('content')
    <div class="bg-[var(--color-valen-dark)] min-h-screen py-16 sm:py-24" x-data="{
                search: '',
                activeCategory: 'all',
                faqs: {{ json_encode($faqs) }},
                get filteredFaqs() {
                    if (this.search === '') {
                        return this.faqs;
                    }
                    return this.faqs.filter(faq => 
                        faq.question.toLowerCase().includes(this.search.toLowerCase()) || 
                        faq.answer.toLowerCase().includes(this.search.toLowerCase())
                    );
                },
                get categories() {
                    return [...new Set(this.filteredFaqs.map(f => f.category))];
                },
                activeAccordion: null
            }">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-16">
                <h1 class="text-4xl font-extrabold text-white sm:text-5xl mb-6">Frequently Asked Questions</h1>
                <p class="text-gray-400 text-lg">Find answers to common questions about our grading process, shipping, and
                    services.</p>
            </div>

            <!-- Search Bar -->
            <div class="max-w-2xl mx-auto mb-16">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" x-model="search"
                        class="block w-full pl-12 pr-4 py-4 bg-[#1C1E21] border border-[var(--color-valen-border)] rounded-lg text-white placeholder-gray-500 focus:ring-1 focus:ring-[var(--color-primary)] focus:border-[var(--color-primary)] transition-colors sm:text-md"
                        placeholder="Search">
                </div>
            </div>

            <!-- FAQ Lists -->
            <div class="space-y-12">
                <template x-for="category in categories" :key="category">
                    <div>
                        <h2 class="text-2xl font-bold text-[var(--color-primary)] mb-6" x-text="category"></h2>
                        <div class="space-y-4">
                            <template x-for="(faq, index) in filteredFaqs.filter(f => f.category === category)" :key="faq.id">
                                <div class="bg-[#1C1E21] rounded-lg border border-[var(--color-valen-border)] overflow-hidden">
                                    <button @click="activeAccordion = (activeAccordion === faq.id ? null : faq.id)"
                                        class="w-full px-6 py-5 text-left flex justify-between items-center focus:outline-none hover:bg-[var(--color-valen-dark)] transition-colors">
                                        <span class="text-sm font-medium text-white" x-text="faq.question"></span>
                                        <svg class="w-5 h-5 text-[var(--color-primary)] transform transition-transform duration-200"
                                            :class="{'rotate-180': activeAccordion === faq.id}" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <div x-show="activeAccordion === faq.id" x-collapse style="display: none;">
                                        <div class="px-6 pb-5 text-sm text-gray-400 leading-relaxed border-t border-gray-800 pt-4"
                                            x-text="faq.answer"></div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
@endsection