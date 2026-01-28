@extends('layouts.frontend')

@section('content')
    <div class="bg-[var(--color-valen-dark)] min-h-screen py-16 sm:py-24" x-data="{
                search: '',
                activeCategory: 'all',
                faqs: [
                    {
                        category: 'General',
                        question: 'What is card grading and why should I grade my cards?',
                        answer: 'Card grading is the process of submitting your trading cards to a professional third-party service for authentication and condition evaluation. Grading encapsulates your card in a protective case (slab) and assigns it a numeric grade (1-10), which can significantly increase its value and liquidity.'
                    },
                    {
                        category: 'General',
                        question: 'Services',
                        answer: 'We offer various service levels ranging from Standard to Walk-Through, depending on your turnaround time needs and the declared value of your cards.'
                    },
                    {
                        category: 'General',
                        question: 'Contact us',
                        answer: 'You can reach our support team via email at support@valengrading.com or through our Contact page form. We typically respond within 24 hours.'
                    },
                    {
                        category: 'Shipping & Packaging',
                        question: 'What is card grading and why should I grade my cards?',
                        answer: 'Shipping your cards securely is crucial. We recommend using penny sleeves and semi-rigid holders (Card Savers), sandwiched between cardboard and bubble wrap.'
                    },
                    {
                        category: 'Shipping & Packaging',
                        question: 'Services',
                        answer: 'We use insured carriers for all return shipments. Signatures are required for high-value packages.'
                    },
                    {
                        category: 'Shipping & Packaging',
                        question: 'Contact us',
                        answer: 'If you have questions about a shipment, please contact our shipping department directly.'
                    }
                ],
                get filteredFaqs() {
                    if (this.search === '') {
                        return this.faqs;
                    }
                    return this.faqs.filter(faq => 
                        faq.question.toLowerCase().includes(this.search.toLowerCase()) || 
                        faq.answer.toLowerCase().includes(this.search.toLowerCase())
                    );
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
                <!-- General Category -->
                <div x-show="filteredFaqs.some(f => f.category === 'General')">
                    <h2 class="text-2xl font-bold text-[var(--color-primary)] mb-6">General</h2>
                    <div class="space-y-4">
                        <template x-for="(faq, index) in filteredFaqs.filter(f => f.category === 'General')" :key="index">
                            <div class="bg-[#1C1E21] rounded-lg border border-[var(--color-valen-border)] overflow-hidden">
                                <button @click="activeAccordion = (activeAccordion === index ? null : index)"
                                    class="w-full px-6 py-5 text-left flex justify-between items-center focus:outline-none hover:bg-[var(--color-valen-dark)] transition-colors">
                                    <span class="text-sm font-medium text-white" x-text="faq.question"></span>
                                    <svg class="w-5 h-5 text-[var(--color-primary)] transform transition-transform duration-200"
                                        :class="{'rotate-180': activeAccordion === index}" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-show="activeAccordion === index" x-collapse style="display: none;">
                                    <div class="px-6 pb-5 text-sm text-gray-400 leading-relaxed border-t border-gray-800 pt-4"
                                        x-text="faq.answer"></div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Shipping Category -->
                <div x-show="filteredFaqs.some(f => f.category === 'Shipping & Packaging')">
                    <h2 class="text-xl font-bold text-[var(--color-primary)] mb-6">Shipping & Packaging</h2>
                    <div class="space-y-4">
                        <template x-for="(faq, index) in filteredFaqs.filter(f => f.category === 'Shipping & Packaging')"
                            :key="'ship-' + index">
                            <div class="bg-[#1C1E21] rounded-lg border border-[var(--color-valen-border)] overflow-hidden">
                                <button
                                    @click="activeAccordion = (activeAccordion === 'ship-' + index ? null : 'ship-' + index)"
                                    class="w-full px-6 py-5 text-left flex justify-between items-center focus:outline-none hover:bg-[var(--color-valen-dark)] transition-colors">
                                    <span class="text-sm font-medium text-white" x-text="faq.question"></span>
                                    <svg class="w-5 h-5 text-[var(--color-primary)] transform transition-transform duration-200"
                                        :class="{'rotate-180': activeAccordion === 'ship-' + index}" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-show="activeAccordion === 'ship-' + index" x-collapse style="display: none;">
                                    <div class="px-6 pb-5 text-sm text-gray-400 leading-relaxed border-t border-gray-800 pt-4"
                                        x-text="faq.answer"></div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection