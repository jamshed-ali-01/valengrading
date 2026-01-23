<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-red-600 to-[#A3050A] border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:scale-[1.02] shadow-[0_0_15px_rgba(163,5,10,0.3)] transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
