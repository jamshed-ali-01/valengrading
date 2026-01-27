@extends('layouts.app')

@section('title', 'Report Private - ValenGrading')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4">
    <div class="max-w-xl w-full text-center">
        <div class="w-24 h-24 bg-red-500/10 rounded-full flex items-center justify-center mx-auto mb-8 border border-red-500/20">
            <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H10m11 1a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        
        <h1 class="text-3xl font-bold text-white mb-4">Report Under Preparation</h1>
        <p class="text-gray-400 mb-12">Certification <span class="text-white font-bold">#{{ $card->cert_number }}</span> has been registered but the grading report is not yet commercially available for public viewing. Please check back later.</p>

        <a href="{{ route('cert.index') }}" class="inline-flex items-center gap-2 text-red-500 font-bold uppercase tracking-widest text-sm hover:text-red-400 transition-colors group">
            <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span>Back to Search</span>
        </a>
    </div>
</div>
@endsection
