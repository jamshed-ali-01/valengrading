<x-guest-layout>
    <!-- Header -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-white mb-2">Create Account</h2>
        <p class="text-gray-400 text-sm">Join Valen Grading today</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-5">
            <label for="name" class="block text-white font-bold mb-2 text-sm">Full Name</label>
            <input id="name" 
                   type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   required 
                   autofocus 
                   autocomplete="name"
                   placeholder="Enter your full name"
                   class="w-full rounded bg-white text-gray-900 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-[#0ea5e9] placeholder-gray-400">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-5">
            <label for="email" class="block text-white font-bold mb-2 text-sm">Email</label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autocomplete="username"
                   placeholder="Enter your email"
                   class="w-full rounded bg-white text-gray-900 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-[#0ea5e9] placeholder-gray-400">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-5">
            <label for="password" class="block text-white font-bold mb-2 text-sm">Password</label>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="new-password"
                   placeholder="Create a password"
                   class="w-full rounded bg-white text-gray-900 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-[#0ea5e9] placeholder-gray-400">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-8">
            <label for="password_confirmation" class="block text-white font-bold mb-2 text-sm">Confirm Password</label>
            <input id="password_confirmation" 
                   type="password" 
                   name="password_confirmation" 
                   required 
                   autocomplete="new-password"
                   placeholder="Confirm your password"
                   class="w-full rounded bg-white text-gray-900 border-none px-4 py-3 text-sm focus:ring-2 focus:ring-[#0ea5e9] placeholder-gray-400">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-[#A3050A] hover:bg-[#850408] text-white font-normal text-lg py-3 rounded-lg transition-colors shadow-lg">
            Register
        </button>

        <div class="mt-8 text-center">
            <a class="text-white hover:text-gray-300 text-sm font-bold" href="{{ route('login') }}">
                Already have an account?
            </a>
        </div>
    </form>
</x-guest-layout>
