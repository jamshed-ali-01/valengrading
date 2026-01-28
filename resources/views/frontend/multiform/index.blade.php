@extends('layouts.frontend')

@section('content')
    <div class="bg-gray-100 min-h-screen py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Multi-Step Submission Form
                    </div>

                    <div class="mt-6 text-gray-500">
                        This is where the multi-step form will be implemented.
                    </div>
                </div>

                <div class="bg-gray-200 bg-opacity-25 p-6">
                    <!-- Placeholder for Steps -->
                    <nav aria-label="Progress">
                        <ol role="list" class="space-y-4 md:flex md:space-y-0 md:space-x-8">
                            <li class="md:flex-1">
                                <a href="#"
                                    class="group pl-4 py-2 flex flex-col border-l-4 border-[var(--color-primary)] hover:border-[var(--color-primary-hover)] md:pl-0 md:pt-4 md:pb-0 md:border-l-0 md:border-t-4">
                                    <span
                                        class="text-xs text-[var(--color-primary)] font-semibold tracking-wide uppercase group-hover:text-[var(--color-primary-hover)]">Step
                                        1</span>
                                    <span class="text-sm font-medium">Personal Details</span>
                                </a>
                            </li>
                            <li class="md:flex-1">
                                <a href="#"
                                    class="group pl-4 py-2 flex flex-col border-l-4 border-gray-200 hover:border-gray-300 md:pl-0 md:pt-4 md:pb-0 md:border-l-0 md:border-t-4">
                                    <span class="text-xs text-gray-500 font-semibold tracking-wide uppercase">Step 2</span>
                                    <span class="text-sm font-medium">Submission Info</span>
                                </a>
                            </li>
                            <li class="md:flex-1">
                                <a href="#"
                                    class="group pl-4 py-2 flex flex-col border-l-4 border-gray-200 hover:border-gray-300 md:pl-0 md:pt-4 md:pb-0 md:border-l-0 md:border-t-4">
                                    <span class="text-xs text-gray-500 font-semibold tracking-wide uppercase">Step 3</span>
                                    <span class="text-sm font-medium">Review & Pay</span>
                                </a>
                            </li>
                        </ol>
                    </nav>

                    <div class="mt-8">
                        <!-- Form Content Placeholder -->
                        <div
                            class="border-4 border-dashed border-gray-200 rounded-lg h-64 flex items-center justify-center">
                            <span class="text-gray-400 font-medium">Form Wizard Component Here</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection