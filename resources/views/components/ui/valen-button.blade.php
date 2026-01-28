@props(['type' => 'button', 'variant' => 'primary'])

@php
    $baseClasses = 'inline-flex items-center justify-center px-6 py-3 rounded text-sm font-medium transition-all duration-200 focus:outline-none';
    $variants = [
        'primary' => 'bg-[var(--color-primary)] hover:bg-[var(--color-primary-hover)] text-white shadow-[0_0_10px_rgba(239,68,68,0.2)]',
        'outline' => 'bg-transparent border border-[var(--color-primary)] text-[var(--color-primary)] hover:bg-[var(--color-primary)] hover:text-white',
        'secondary' => 'bg-[var(--color-valen-border)] hover:bg-gray-700 text-white',
    ];
    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>