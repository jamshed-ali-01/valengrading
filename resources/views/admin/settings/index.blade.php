@extends('layouts.admin')

@section('title', 'Admin Settings')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white">System Settings</h2>
        <p class="text-gray-400">Manage your profile, security, and global application configurations.</p>
    </div>

    @if(session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 px-6 py-4 rounded-xl font-medium mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Navigation -->
        <div class="lg:col-span-1">
            <nav class="space-y-2 sticky top-6">
                <button onclick="switchTab('general')" id="tab-btn-general" class="setting-tab-btn w-full text-left px-5 py-3 rounded-xl transition-all font-bold text-sm uppercase tracking-wider flex items-center gap-3 active-tab">
                    <svg class="w-5 h-5 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    General
                </button>
                <button onclick="switchTab('profile')" id="tab-btn-profile" class="setting-tab-btn w-full text-left px-5 py-3 rounded-xl transition-all font-bold text-sm uppercase tracking-wider flex items-center gap-3 inactive-tab">
                    <svg class="w-5 h-5 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Profile
                </button>
                <button onclick="switchTab('security')" id="tab-btn-security" class="setting-tab-btn w-full text-left px-5 py-3 rounded-xl transition-all font-bold text-sm uppercase tracking-wider flex items-center gap-3 inactive-tab">
                    <svg class="w-5 h-5 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    Security
                </button>
            </nav>
        </div>

        <!-- Main Content Area -->
        <div class="lg:col-span-3">
            <div class="bg-[#232528]/80 backdrop-blur-xl border border-white/5 rounded-2xl shadow-2xl overflow-hidden min-h-[500px]">
                
                <!-- General Settings -->
                <div id="tab-general" class="setting-tab p-8">
                    <h3 class="text-xl font-bold text-white mb-8 border-b border-white/5 pb-4">Global Configuration</h3>
                    <form action="{{ route('admin.settings.update-general') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')
                        <div>
                            <label class="block text-sm font-bold text-gray-400 uppercase tracking-widest mb-3">Admin Notification Email</label>
                            <input type="email" name="admin_notification_email" value="{{ $adminNotificationEmail }}"
                                class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-colors placeholder-gray-600"
                                placeholder="Where should new order emails be sent?">
                            <p class="mt-2 text-xs text-gray-500 italic">This email will receive notifications for every successful payment/submission.</p>
                        </div>
                        <div class="pt-4 border-t border-white/5">
                            <button type="submit" class="bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold px-8 py-3 rounded-xl shadow-lg transition-transform hover:scale-105 active:scale-95">
                                Save General Settings
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Profile Settings -->
                <div id="tab-profile" class="setting-tab p-8 hidden">
                    <h3 class="text-xl font-bold text-white mb-8 border-b border-white/5 pb-4">Profile Information</h3>
                    <form action="{{ route('admin.settings.update-profile') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-400 uppercase tracking-widest mb-3">Full Name</label>
                                <input type="text" name="name" value="{{ auth()->user()->name }}"
                                    class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-400 uppercase tracking-widest mb-3">Login Email</label>
                                <input type="email" name="email" value="{{ auth()->user()->email }}"
                                    class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-colors">
                            </div>
                        </div>
                        <div class="pt-4 border-t border-white/5">
                            <button type="submit" class="bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold px-8 py-3 rounded-xl shadow-lg transition-transform hover:scale-105 active:scale-95">
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Security Settings -->
                <div id="tab-security" class="setting-tab p-8 hidden">
                    <h3 class="text-xl font-bold text-white mb-8 border-b border-white/5 pb-4">Security & Password</h3>
                    <form action="{{ route('admin.settings.update-password') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')
                        <div>
                            <label class="block text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">Current Password</label>
                            <input type="password" name="current_password"
                                class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-colors">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">New Password</label>
                                <input type="password" name="password"
                                    class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">Confirm New Password</label>
                                <input type="password" name="password_confirmation"
                                    class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-colors">
                            </div>
                        </div>
                        <div class="pt-4 border-t border-white/5">
                            <button type="submit" class="bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold px-8 py-3 rounded-xl shadow-lg transition-transform hover:scale-105 active:scale-95">
                                Change Password
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .setting-tab-btn.active-tab {
        background: #A3050A;
        color: white;
        box-shadow: 0 10px 15px -3px rgba(163, 5, 10, 0.4);
    }
    .setting-tab-btn.inactive-tab {
        color: #9ca3af;
    }
    .setting-tab-btn.inactive-tab:hover {
        background: rgba(255, 255, 255, 0.05);
        color: white;
    }
</style>

<script>
    function switchTab(tabId) {
        // Hide all tabs
        document.querySelectorAll('.setting-tab').forEach(tab => tab.classList.add('hidden'));
        // Show active tab
        document.getElementById('tab-' + tabId).classList.remove('hidden');

        // Update buttons
        document.querySelectorAll('.setting-tab-btn').forEach(btn => {
            btn.classList.remove('active-tab');
            btn.classList.add('inactive-tab');
        });
        document.getElementById('tab-btn-' + tabId).classList.add('active-tab');
        document.getElementById('tab-btn-' + tabId).classList.remove('inactive-tab');
    }
</script>
@endsection
