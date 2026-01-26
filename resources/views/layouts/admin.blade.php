<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ValenGrading</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#15171A] text-white font-['Outfit'] antialiased">
    <div class="flex min-h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#232528] border-r border-white/5 flex-shrink-0 flex flex-col hidden md:flex">
            <div class="p-6">
                <h1 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-red-500 to-[#A3050A]">ValenAdmin</h1>
            </div>
            
            <nav class="flex-1 px-4 space-y-1 overflow-y-auto pb-4 pt-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-[#A3050A] to-red-700 text-white shadow-lg shadow-red-900/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                <div class="pt-6 pb-2 px-4 uppercase text-[10px] font-bold text-gray-500 tracking-wider">Management</div>

                <a href="{{ route('admin.submissions.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.submissions.*') ? 'bg-gradient-to-r from-[#A3050A] to-red-700 text-white shadow-lg shadow-red-900/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    <span class="font-medium">Submissions</span>
                </a>

                <a href="{{ route('admin.service-levels.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.service-levels.*') ? 'bg-gradient-to-r from-[#A3050A] to-red-700 text-white shadow-lg shadow-red-900/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    <span class="font-medium">Service Levels</span>
                </a>

                <a href="{{ route('admin.label-types.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.label-types.*') ? 'bg-gradient-to-r from-[#A3050A] to-red-700 text-white shadow-lg shadow-red-900/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M13 7h.01M13 11h.01M13 15h.01M17 7h.01M17 11h.01M17 15h.01"></path></svg>
                    <span class="font-medium">Label Types</span>
                </a>

                <a href="{{ route('admin.submission-types.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('admin.submission-types.*') ? 'bg-gradient-to-r from-[#A3050A] to-red-700 text-white shadow-lg shadow-red-900/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span class="font-medium">Services</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto relative bg-[#15171A]">
            <!-- Top Header -->
            <header class="h-16 border-b border-white/5 flex items-center justify-between px-8 sticky top-0 bg-[#15171A]/80 backdrop-blur-xl z-20">
                <h2 class="text-lg font-semibold text-white">@yield('title', 'Admin Panel')</h2>
                <div class="flex items-center gap-6">
                    <!-- Notifications -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="text-gray-400 hover:text-white transition-colors relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            <span id="notification-count" class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full text-[10px] font-bold flex items-center justify-center text-white border-2 border-[#15171A] {{ auth()->user()->unreadNotifications->count() > 0 ? '' : 'hidden' }}">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-3 w-80 bg-[#232528] border border-white/5 rounded-2xl shadow-2xl overflow-hidden py-2 z-50">
                            <div class="px-4 py-3 border-b border-white/5 flex justify-between items-center">
                                <span class="font-bold text-sm">Notifications</span>
                                @if(auth()->user()->unreadNotifications->count() > 0)
                                    <form action="{{ route('admin.notifications.mark-all-read') }}" method="POST" id="mark-all-read-form">
                                        @csrf
                                        <button type="submit" class="text-[10px] text-gray-500 uppercase tracking-widest cursor-pointer hover:text-red-500">Mark all read</button>
                                    </form>
                                @endif
                            </div>
                            <div id="notification-list" class="max-h-64 overflow-y-auto">
                                @forelse(auth()->user()->unreadNotifications as $notification)
                                    <a href="{{ route('admin.submissions.show', $notification->data['submission_id'] ?? '') }}" class="block px-4 py-3 hover:bg-white/5 border-b border-white/5 transition-colors">
                                        <p class="text-xs text-white font-medium mb-1">{{ $notification->data['message'] ?? 'New Notification' }}</p>
                                        <p class="text-[10px] text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                    </a>
                                @empty
                                    <div id="no-notifications-msg" class="px-4 py-8 text-center text-gray-500 italic text-sm">
                                        No new notifications
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="h-6 w-px bg-white/5"></div>

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-3 hover:bg-white/5 p-2 rounded-xl transition-colors">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-bold text-white leading-none mb-1">{{ auth()->user()->name }}</p>
                                <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Administrator</p>
                            </div>
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-red-500 to-[#A3050A] flex items-center justify-center text-sm font-bold shadow-lg shadow-red-900/20 border border-white/10 ring-2 ring-white/5">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-3 w-56 bg-[#232528] border border-white/5 rounded-2xl shadow-2xl overflow-hidden py-1 z-50">
                            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-2 px-4 py-3 text-sm text-gray-300 hover:bg-white/5 hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Settings
                            </a>
                            <div class="h-px bg-white/5 my-1"></div>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 w-full px-4 py-3 text-sm text-red-400 hover:bg-red-500/10 hover:text-red-500 transition-colors text-left">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-8">
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm font-medium flex items-center gap-3">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm font-medium flex items-center gap-3">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>

            <!-- Background Decorations -->
            <div class="fixed top-0 right-0 w-[500px] h-[500px] bg-red-500/5 rounded-full blur-[120px] -z-10"></div>
            <div class="fixed bottom-0 left-64 w-[500px] h-[500px] bg-red-900/5 rounded-full blur-[120px] -z-10"></div>
        </main>
    </div>    <!-- Real-time Notification Toast -->
    <div id="notification-toast" class="fixed top-24 right-8 bg-[#232528] border border-l-4 border-emerald-500 text-white px-6 py-4 rounded-lg shadow-2xl z-50 transform transition-all duration-300 translate-x-full opacity-0 flex items-center gap-4">
        <div class="bg-emerald-500/20 p-2 rounded-full text-emerald-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
        </div>
        <div>
            <h4 class="font-bold text-sm" id="toast-title">New Submission!</h4>
            <p class="text-xs text-gray-400" id="toast-message">New submission received.</p>
        </div>
        <button onclick="document.getElementById('notification-toast').classList.add('translate-x-full', 'opacity-0')" class="text-gray-400 hover:text-white ml-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <!-- Notification Sound -->
    <audio id="notification-sound" src="https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3" preload="auto"></audio>

    @vite('resources/js/app.js')
    
    <script type="module">
        // Request Browser Notification Permission
        if ("Notification" in window) {
            if (Notification.permission !== "granted" && Notification.permission !== "denied") {
                Notification.requestPermission();
            }
        }

        // Wait for Echo to be initialized
        setTimeout(() => {
            if (window.Echo) {
                window.Echo.channel('admin-notifications')
                    .listen('NewSubmissionEvent', (e) => {
                        console.log('New Submission Event:', e);
                        
                        // 1. Play sound
                        try {
                            const audio = document.getElementById('notification-sound');
                            audio.currentTime = 0;
                            audio.play().catch(err => console.log('Audio play failed:', err));
                        } catch (err) {
                            console.log('Audio error', err);
                        }

                        // 2. Trigger Browser Push Notification
                        if ("Notification" in window && Notification.permission === "granted") {
                            new Notification('New Order: ' + e.submission_no, {
                                body: e.user_name + ' submitted ' + e.amount + ' cards',
                                icon: '/favicon.ico' // Ensure you have a favicon or use a generic icon URL
                            });
                        }

                        // 3. Update Badge Count
                        const badge = document.getElementById('notification-count');
                        if (badge) {
                            let count = parseInt(badge.innerText) || 0;
                            badge.innerText = count + 1;
                            badge.classList.remove('hidden');
                        }

                        // 4. Update Notification List
                        const list = document.getElementById('notification-list');
                        const emptyMsg = document.getElementById('no-notifications-msg');
                        if (list) {
                            if (emptyMsg) emptyMsg.remove();
                            
                            const newNotification = `
                                <a href="/admin/submissions/${e.id}" class="block px-4 py-3 hover:bg-white/5 border-b border-white/5 transition-colors animate-pulse">
                                    <p class="text-xs text-white font-medium mb-1">${e.message}</p>
                                    <p class="text-[10px] text-gray-500">Just now</p>
                                </a>
                            `;
                            list.insertAdjacentHTML('afterbegin', newNotification);
                        }

                        // 5. Update Toast
                        document.getElementById('toast-title').innerText = 'New Order: ' + e.submission_no;
                        document.getElementById('toast-message').innerText = e.user_name + ' submitted ' + e.amount + ' cards';
                        
                        const toast = document.getElementById('notification-toast');
                        toast.classList.remove('translate-x-full', 'opacity-0');
                        
                        setTimeout(() => {
                            toast.classList.add('translate-x-full', 'opacity-0');
                        }, 8000);
                    });
            } else {
                console.error('Echo not initialized');
            }
        }, 1000);
    </script>
</body>
</html>
