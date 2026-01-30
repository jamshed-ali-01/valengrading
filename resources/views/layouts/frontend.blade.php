<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('images/logo.avif') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[var(--color-valen-dark)] font-sans antialiased text-[var(--color-text-main)] overflow-x-hidden"
    x-data="{ mobileMenuOpen: false }">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        @include('partials.header')

        <!-- Main Content -->
        <main class="flex-grow">
            <div class="animate-fade-in">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        @include('partials.footer')
    </div>
    @include('components.login-modal')
</body>

</html>