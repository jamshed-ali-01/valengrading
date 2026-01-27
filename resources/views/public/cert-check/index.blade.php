@extends('layouts.app')

@section('title', 'Cert Check - ' . \App\Models\SiteSetting::get('site_name', 'Valen Grading'))

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4">
    <div class="max-w-xl w-full">
        <div class="text-center mb-12">
            @if($logo = \App\Models\SiteSetting::get('site_logo'))
                <div class="mb-6 flex justify-center">
                    <img src="{{ $logo }}" class="h-16 w-auto object-contain" alt="Logo">
                </div>
            @endif
            <h1 class="text-4xl font-bold text-white mb-4">Certification Verification</h1>
            <p class="text-gray-400">Enter a certification number to verify its authenticity and view the grading report.</p>
        </div>

        <div class="bg-[#232528]/80 backdrop-blur-xl border border-white/5 rounded-[2.5rem] p-8 shadow-2xl relative overflow-hidden group">
            <!-- Decorative Glow -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-red-500/5 rounded-full blur-3xl -mr-32 -mt-32"></div>

            <form action="{{ route('cert.search') }}" method="POST" class="relative z-10 space-y-6">
                @csrf
                @if(session('error'))
                    <div class="bg-red-500/10 border border-red-500/20 text-red-500 px-4 py-3 rounded-xl text-sm font-medium">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="space-y-4">
                    <label for="cert_number" class="block text-xs font-bold text-gray-500 uppercase tracking-[0.2em] ml-2">Certification Number</label>
                    <div class="relative">
                        <input type="text" name="cert_number" id="cert_number" required autofocus
                            class="w-full bg-[#15171A] border border-white/10 rounded-2xl px-6 py-5 text-xl font-bold text-white placeholder-gray-700 focus:outline-none focus:border-red-500 transition-all uppercase tracking-widest"
                            placeholder="e.g. 419901">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-6">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold py-5 rounded-2xl transition-all shadow-xl shadow-red-900/20 uppercase tracking-[0.2em] text-sm hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-3 group">
                    <span>Search Database</span>
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>
        </div>

        <div class="mt-12 grid grid-cols-2 gap-4">
            <div class="p-6 bg-white/2 rounded-2xl border border-white/5 text-center">
                <span class="block text-2xl font-bold text-white mb-1">100%</span>
                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Verified Authenticity</span>
            </div>
            <div class="p-6 bg-white/2 rounded-2xl border border-white/5 text-center">
                <span class="block text-2xl font-bold text-white mb-1">Instant</span>
                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Digital Reports</span>
            </div>
        </div>
    </div>
</div>
@endsection
