<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-white mb-2">Welcome Back</h2>
        <p class="text-gray-400 text-sm">Sign in to your Valen Grading account</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-5">
            <label for="email" class="block text-white font-bold mb-2 text-sm">Email</label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   autocomplete="username"
                   placeholder="Enter your email"
                   class="w-full rounded bg-white text-gray-900 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-[#0ea5e9] placeholder-gray-400">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-6">
            <div class="flex justify-between items-center mb-2">
                <label for="password" class="block text-white font-bold text-sm">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-[#dc2626] hover:text-[#b91c1c] text-sm font-bold no-underline" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>
            
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="current-password"
                   placeholder="Enter your password"
                   class="w-full rounded bg-white text-gray-900 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-[#0ea5e9] placeholder-gray-400">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-[#A3050A] hover:bg-[#850408] text-white font-normal text-lg py-3 rounded-lg transition-colors shadow-lg">
            Sign In
        </button>
        
        <!-- Register Link -->
        <div class="mt-8 text-center">
            <a href="{{ route('register') }}" class="text-white hover:text-gray-300 text-sm font-bold">
                Don't have an account?
            </a>
        </div>
    </form>
</x-guest-layout>
