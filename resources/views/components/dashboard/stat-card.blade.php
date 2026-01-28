@props(['title', 'value', 'icon', 'color' => 'text-[var(--color-primary)]', 'iconBg' => 'bg-none'])

<div
    class="bg-[var(--color-valen-light)] rounded-lg p-6 border border-[var(--color-valen-border)] flex flex-col justify-between h-full relative overflow-hidden group hover:border-[var(--color-primary)] transition-colors duration-300">
    <div class="flex justify-between items-start mb-4">
        <div>
            <p class="text-gray-400 text-xs font-medium uppercase tracking-wider">{{ $title }}</p>
            <h3 class="text-3xl font-bold text-white mt-1">{{ $value }}</h3>
        </div>
        <div class="p-2 rounded-full {{ $iconBg }}">
            {{ $slot }}
        </div>
    </div>

    <!-- Bottom accent line -->
    <div
        class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-[var(--color-primary)] to-transparent opacity-50">
    </div>
</div>