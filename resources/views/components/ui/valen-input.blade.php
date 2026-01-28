@props(['label', 'name', 'type' => 'text', 'placeholder' => '', 'value' => ''])

<div class="w-full">
    <label for="{{ $name }}" class="block text-xs font-medium text-gray-400 mb-1 uppercase tracking-wide">
        {{ $label }}
    </label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}"
        class="w-full bg-black border border-[var(--color-valen-border)] rounded-lg px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-[var(--color-primary)] focus:ring-1 focus:ring-[var(--color-primary)] transition-all">
</div>