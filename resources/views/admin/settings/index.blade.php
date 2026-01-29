@extends('layouts.admin')

@section('title', 'Admin Settings')

@section('content')
<div class="w-full space-y-6">
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
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    General
                </button>
                <button onclick="switchTab('smtp')" id="tab-btn-smtp" class="setting-tab-btn w-full text-left px-5 py-3 rounded-xl transition-all font-bold text-sm uppercase tracking-wider flex items-center gap-3 inactive-tab">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    SMTP Settings
                </button>
                <button onclick="switchTab('shipping')" id="tab-btn-shipping" class="setting-tab-btn w-full text-left px-5 py-3 rounded-xl transition-all font-bold text-sm uppercase tracking-wider flex items-center gap-3 inactive-tab">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Shipping Address
                </button>
                <div class="h-px bg-white/5 my-4"></div>
                <button onclick="switchTab('profile')" id="tab-btn-profile" class="setting-tab-btn w-full text-left px-5 py-3 rounded-xl transition-all font-bold text-sm uppercase tracking-wider flex items-center gap-3 inactive-tab">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    My Profile
                </button>
                <button onclick="switchTab('security')" id="tab-btn-security" class="setting-tab-btn w-full text-left px-5 py-3 rounded-xl transition-all font-bold text-sm uppercase tracking-wider flex items-center gap-3 inactive-tab">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    Security
                </button>
            </nav>
        </div>

        <!-- Main Content Area -->
        <div class="lg:col-span-3">
            <div class="bg-[#232528]/80 backdrop-blur-xl border border-white/5 rounded-2xl shadow-2xl overflow-hidden min-h-[500px]">
                
                <!-- General Settings -->
                <div id="tab-general" class="setting-tab p-8">
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-white leading-tight">Global Configuration</h3>
                        <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest font-bold">Manage core application notifications</p>
                    </div>
                    <form action="{{ route('admin.settings.update-general') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @method('PATCH')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Site Name</label>
                                <input type="text" name="site_name" value="{{ old('site_name', $site_name) }}"
                                    class="w-full bg-[#15171A] border {{ $errors->has('site_name') ? 'border-red-500/50' : 'border-white/10' }} rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all font-medium"
                                    placeholder="Valen Grading">
                                @error('site_name') <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Admin Notification Email</label>
                                <input type="email" name="admin_notification_email" value="{{ old('admin_notification_email', $admin_notification_email) }}"
                                    class="w-full bg-[#15171A] border @error('admin_notification_email') border-red-500/50 @else border-white/10 @enderror rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all font-medium"
                                    placeholder="admin@valengrading.com">
                                @error('admin_notification_email') <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Return Shipping Fee (€)</label>
                                <div class="relative">
                                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-500 font-bold">€</span>
                                    <input type="number" step="0.01" name="return_shipping_fee" value="{{ old('return_shipping_fee', $return_shipping_fee) }}"
                                        class="w-full bg-[#15171A] border {{ $errors->has('return_shipping_fee') ? 'border-red-500/50' : 'border-white/10' }} rounded-xl pl-10 pr-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all font-medium"
                                        placeholder="7.99">
                                </div>
                                @error('return_shipping_fee') <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p> @enderror
                            </div>
                            {{-- Site Logo Removed --}}
                        </div>
                        <div class="flex items-start gap-3 p-4 bg-white/2 rounded-xl border border-white/5">
                            <svg class="w-5 h-5 text-gray-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-xs text-gray-500 leading-relaxed italic">These are the primary branding and global pricing details used across the public and admin sites.</p>
                        </div>
                        <div class="pt-6 border-t border-white/5">
                            <button type="submit" class="bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold px-10 py-4 rounded-xl shadow-2xl shadow-red-900/20 transition-all hover:scale-[1.02] active:scale-[0.98] uppercase tracking-widest text-xs">
                                Save General Config
                            </button>
                        </div>
                    </form>
                </div>

                <!-- SMTP Settings -->
                <div id="tab-smtp" class="setting-tab p-8 hidden">
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-white leading-tight">SMTP Mail Server</h3>
                        <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest font-bold">Configure outgoing email delivery</p>
                    </div>
                    <form action="{{ route('admin.settings.update-smtp') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest">Mail Host</label>
                                <input type="text" name="mail_host" value="{{ old('mail_host', $mail_host) }}" class="w-full bg-[#15171A] border @error('mail_host') border-red-500/50 @else border-white/10 @enderror rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all">
                                @error('mail_host') <p class="text-red-500 text-[10px] font-bold">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest">Mail Port</label>
                                <input type="text" name="mail_port" value="{{ old('mail_port', $mail_port) }}" class="w-full bg-[#15171A] border @error('mail_port') border-red-500/50 @else border-white/10 @enderror rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all">
                                @error('mail_port') <p class="text-red-500 text-[10px] font-bold">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest">Username</label>
                                <input type="text" name="mail_username" value="{{ old('mail_username', $mail_username) }}" class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all">
                                @error('mail_username') <p class="text-red-500 text-[10px] font-bold">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest">Password</label>
                                <input type="password" name="mail_password" value="{{ old('mail_password', $mail_password) }}" class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all">
                                @error('mail_password') <p class="text-red-500 text-[10px] font-bold">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest">Encryption</label>
                                <select name="mail_encryption" class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all appearance-none cursor-pointer">
                                    <option value="tls" {{ old('mail_encryption', $mail_encryption) == 'tls' ? 'selected' : '' }}>TLS</option>
                                    <option value="ssl" {{ old('mail_encryption', $mail_encryption) == 'ssl' ? 'selected' : '' }}>SSL</option>
                                    <option value="none" {{ old('mail_encryption', $mail_encryption) == 'none' ? 'selected' : '' }}>None</option>
                                </select>
                                @error('mail_encryption') <p class="text-red-500 text-[10px] font-bold">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest">From Address</label>
                                <input type="email" name="mail_from_address" value="{{ old('mail_from_address', $mail_from_address) }}" class="w-full bg-[#15171A] border @error('mail_from_address') border-red-500/50 @else border-white/10 @enderror rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all" placeholder="hello@valengrading.com">
                                @error('mail_from_address') <p class="text-red-500 text-[10px] font-bold">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2 md:col-span-2">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest">From Name</label>
                                <input type="text" name="mail_from_name" value="{{ old('mail_from_name', $mail_from_name) }}" class="w-full bg-[#15171A] border @error('mail_from_name') border-red-500/50 @else border-white/10 @enderror rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all">
                                @error('mail_from_name') <p class="text-red-500 text-[10px] font-bold">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="pt-6 border-t border-white/5">
                            <button type="submit" class="bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold px-10 py-4 rounded-xl shadow-2xl shadow-red-900/20 transition-all hover:scale-[1.02] active:scale-[0.98] uppercase tracking-widest text-xs">
                                Update Mail Engine
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Shipping Settings -->
                <div id="tab-shipping" class="setting-tab p-8 hidden">
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-white leading-tight">Return & Receiver Address</h3>
                        <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest font-bold">Where customers should send their cards</p>
                    </div>
                    <form action="{{ route('admin.settings.update-shipping') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest">Company / Receiver Name</label>
                                <input type="text" name="shipping_name" value="{{ old('shipping_name', $shipping_name) }}" class="w-full bg-[#15171A] border @error('shipping_name') border-red-500/50 @else border-white/10 @enderror rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all" placeholder="Valen Grading">
                                @error('shipping_name') <p class="text-red-500 text-[10px] font-bold">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest">Full Address (As shown on PDF)</label>
                                <textarea name="shipping_address" rows="4" class="w-full bg-[#15171A] border @error('shipping_address') border-red-500/50 @else border-white/10 @enderror rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all resize-none" placeholder="123 Business Street&#10;London, EC1A 1BB&#10;United Kingdom">{{ old('shipping_address', $shipping_address) }}</textarea>
                                @error('shipping_address') <p class="text-red-500 text-[10px] font-bold">{{ $message }}</p> @enderror
                                <p class="text-[10px] text-gray-500 italic">Include City, ZIP, and Country inside this box for the Packing Slip.</p>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest">Phone Number (Optional)</label>
                                <input type="text" name="shipping_phone" value="{{ old('shipping_phone', $shipping_phone) }}" class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all" placeholder="+44 123 456 7890">
                            </div>
                        </div>
                        <div class="pt-6 border-t border-white/5">
                            <button type="submit" class="bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold px-10 py-4 rounded-xl shadow-2xl shadow-red-900/20 transition-all hover:scale-[1.02] active:scale-[0.98] uppercase tracking-widest text-xs">
                                Update Shipping Data
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Profile Settings -->
                <div id="tab-profile" class="setting-tab p-8 hidden">
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-white leading-tight">My Profile</h3>
                        <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest font-bold">Personal administrator credentials</p>
                    </div>
                    <form action="{{ route('admin.settings.update-profile') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Full Name</label>
                                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                                    class="w-full bg-[#15171A] border @error('name') border-red-500/50 @else border-white/10 @enderror rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all">
                                @error('name') <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Login Email</label>
                                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                                    class="w-full bg-[#15171A] border @error('email') border-red-500/50 @else border-white/10 @enderror rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all">
                                @error('email') <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="pt-6 border-t border-white/5">
                            <button type="submit" class="bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold px-10 py-4 rounded-xl shadow-2xl shadow-red-900/20 transition-all hover:scale-[1.02] active:scale-[0.98] uppercase tracking-widest text-xs">
                                Update My Profile
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Security Settings -->
                <div id="tab-security" class="setting-tab p-8 hidden">
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-white leading-tight">Access Control</h3>
                        <p class="text-xs text-gray-500 mt-1 uppercase tracking-widest font-bold">Manage authentication and passwords</p>
                    </div>
                    <form action="{{ route('admin.settings.update-password') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PATCH')
                        <div class="space-y-2">
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Current Password</label>
                            <input type="password" name="current_password"
                                class="w-full bg-[#15171A] border @error('current_password') border-red-500/50 @else border-white/10 @enderror rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all">
                            @error('current_password') <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">New Password</label>
                                <input type="password" name="password"
                                    class="w-full bg-[#15171A] border @error('password') border-red-500/50 @else border-white/10 @enderror rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all">
                                @error('password') <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Confirm New Password</label>
                                <input type="password" name="password_confirmation"
                                    class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all">
                            </div>
                        </div>
                        <div class="pt-6 border-t border-white/5">
                            <button type="submit" class="bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold px-10 py-4 rounded-xl shadow-2xl shadow-red-900/20 transition-all hover:scale-[1.02] active:scale-[0.98] uppercase tracking-widest text-xs">
                                Apply Security Patch
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .setting-tab-btn {
        @apply transition-all duration-300;
    }
    .setting-tab-btn.active-tab {
        background: linear-gradient(to right, #dc2626, #a3050a);
        color: white;
        box-shadow: 0 10px 20px -5px rgba(163, 5, 10, 0.5);
    }
    .setting-tab-btn.inactive-tab {
        color: #6b7280;
    }
    .setting-tab-btn.inactive-tab:hover {
        background: rgba(255, 255, 255, 0.03);
        color: #9ca3af;
    }
    .setting-tab-btn:hover svg {
        @apply text-white;
    }
    input, textarea, select {
        box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.05);
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
        
        // Store last tab in session storage
        sessionStorage.setItem('admin_settings_tab', tabId);
    }

    // Restore tab on load
    window.addEventListener('DOMContentLoaded', () => {
        const lastTab = sessionStorage.getItem('admin_settings_tab');
        if (lastTab && document.getElementById('tab-' + lastTab)) {
            switchTab(lastTab);
        }
    });
</script>
@endsection
