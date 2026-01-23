<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-white antialiased bg-[#15171A]">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div class="w-full mt-6 px-6 py-4 bg-[#232528] shadow-2xl rounded-2xl border border-white/5 max-w-4xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
