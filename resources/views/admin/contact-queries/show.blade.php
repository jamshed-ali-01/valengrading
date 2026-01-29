@extends('layouts.admin')

@section('title', 'View Query')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-white">Message Details</h1>
        <a href="{{ route('admin.contact-queries.index') }}" class="bg-white/10 text-white px-4 py-2 rounded-lg hover:bg-white/20 transition-colors flex items-center gap-2 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to List
        </a>
    </div>

    <!-- Content Card -->
    <div class="bg-[#232528] border border-white/5 rounded-2xl overflow-hidden p-8 space-y-8">
        
        <!-- Meta Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 border-b border-white/5 pb-8">
            <div>
                <h3 class="text-xs uppercase text-gray-500 font-bold tracking-wider mb-1">Sender</h3>
                <p class="text-lg text-white font-medium">{{ $contactQuery->name ?: 'Guest' }}</p>
                <a href="mailto:{{ $contactQuery->email }}" class="text-red-400 hover:text-red-300 text-sm flex items-center gap-2 mt-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    {{ $contactQuery->email }}
                </a>
            </div>
            
            <div class="md:text-right">
                <h3 class="text-xs uppercase text-gray-500 font-bold tracking-wider mb-1">Received At</h3>
                <p class="text-white">{{ $contactQuery->created_at->format('F d, Y') }}</p>
                <p class="text-sm text-gray-400">{{ $contactQuery->created_at->format('h:i A') }}</p>
            </div>
        </div>

        <!-- Subject & Message -->
        <div class="space-y-4">
            <div>
                <h3 class="text-xs uppercase text-gray-500 font-bold tracking-wider mb-2">Subject</h3>
                <p class="text-xl text-white font-medium">{{ $contactQuery->subject ?: 'No Subject' }}</p>
            </div>
            
            <div>
                <h3 class="text-xs uppercase text-gray-500 font-bold tracking-wider mb-3">Message</h3>
                <div class="bg-black/20 rounded-xl p-6 text-gray-300 text-lg leading-relaxed whitespace-pre-wrap border border-white/5">
{{ $contactQuery->message }}
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="pt-8 border-t border-white/5 flex justify-end gap-3">
             <a href="mailto:{{ $contactQuery->email }}?subject=Re: {{ $contactQuery->subject }}&body=%0D%0A%0D%0AOn {{ $contactQuery->created_at->format('M d, Y') }}, {{ $contactQuery->name }} wrote:%0D%0A> {{ str_replace(PHP_EOL, '%0D%0A> ', $contactQuery->message) }}" 
               class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-2 rounded-lg font-bold transition-colors shadow-lg shadow-blue-900/40">
                Reply via Email
            </a>
            
            <form action="{{ route('admin.contact-queries.destroy', $contactQuery) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600/10 hover:bg-red-600/20 text-red-500 border border-red-600/20 px-6 py-2 rounded-lg font-bold transition-colors">
                    Delete Message
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
