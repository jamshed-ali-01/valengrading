@extends('layouts.admin')

@section('title', 'All Notifications')

@section('content')
<div class="space-y-6">
    <div class="bg-[#232528]/80 backdrop-blur-xl border border-white/5 rounded-2xl overflow-hidden shadow-2xl">
        <div class="p-6 border-b border-white/5 flex items-center justify-between">
            <h3 class="text-lg font-bold text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                All Notifications
            </h3>
            @if(auth()->user()->unreadNotifications->count() > 0)
                <form action="{{ route('admin.notifications.mark-all-read') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-white/5 hover:bg-white/10 text-xs font-bold text-white px-4 py-2 rounded-lg border border-white/10 transition-colors uppercase tracking-wider">
                        Mark All Read
                    </button>
                </form>
            @endif
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-white/5 text-gray-400 uppercase text-[10px] font-bold tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Notification Message</th>
                        <th class="px-6 py-4">Date & Time</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($notifications as $notification)
                    <tr class="hover:bg-white/[0.02] transition-colors group">
                        <td class="px-6 py-4">
                            <div class="text-white text-sm font-medium">{{ $notification->data['message'] ?? 'New Notification' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-[10px] text-gray-500 uppercase font-bold">{{ $notification->created_at->format('M d, Y h:i A') }}</div>
                            <div class="text-[10px] text-gray-600">{{ $notification->created_at->diffForHumans() }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($notification->read_at)
                                <span class="text-[10px] bg-gray-500/20 text-gray-400 px-2 py-1 rounded">Read</span>
                            @else
                                <span class="text-[10px] bg-red-500/20 text-red-500 px-2 py-1 rounded font-bold animate-pulse">Unread</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if(isset($notification->data['submission_id']) && ($notification->data['type'] ?? '') !== 'contact_query')
                                <a href="{{ route('admin.submissions.show', $notification->data['submission_id']) }}" class="text-[10px] text-[var(--color-primary)] hover:text-red-400 uppercase font-bold tracking-wider hover:underline">
                                    View Submission
                                </a>
                            @elseif(($notification->data['type'] ?? '') === 'contact_query' || isset($notification->data['form_id']))
                                <a href="{{ route('admin.contact-queries.show', $notification->data['form_id'] ?? $notification->data['submission_id'] ?? '#') }}" class="text-[10px] text-[var(--color-primary)] hover:text-red-400 uppercase font-bold tracking-wider hover:underline">
                                    View Message
                                </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500 italic">
                            No notifications found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-white/5">
            {{ $notifications->links() }}
        </div>
    </div>
</div>
@endsection
