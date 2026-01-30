<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ asset('images/logo.avif') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[var(--color-valen-dark)] font-sans antialiased text-[var(--color-text-main)] overflow-x-hidden" x-data="{ mobileMenuOpen: false }">
        <div class="min-h-screen flex flex-col">
            {{-- Header --}}
            @include('partials.header')

            {{-- Main Content --}}
            <main class="flex-grow flex items-center justify-center p-4">
                <div class="w-full max-w-[480px]">
                    {{-- Logo Removed (Handled in Header) --}}
                    
                    {{-- Card Consumer --}}
                    <div class="w-full px-8 py-10 bg-[#15171a] border-2 border-gray-700 rounded-2xl shadow-xl overflow-hidden">
                        {{ $slot }}
                    </div>
                </div>
            </main>

            {{-- Footer --}}
            @include('partials.footer')
        </div>
    </body>
</html>
