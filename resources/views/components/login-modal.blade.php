<div id="login-modal" class="fixed inset-0 z-[100] hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-[#000]/80 backdrop-blur-sm transition-opacity"></div>

    <!-- Modal Content -->
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-[#15171A] w-full max-w-[440px] rounded-2xl border border-white/5 shadow-2xl overflow-hidden p-8 sm:p-10 transition-all transform scale-100">
            <!-- Glassmorphism Orbs -->
            <div class="absolute top-0 right-0 w-32 h-32 bg-red-500/10 rounded-full blur-3xl -z-10"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-red-900/10 rounded-full blur-3xl -z-10"></div>

            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-white mb-2 tracking-tight">Welcome Back</h2>
                <p class="text-gray-400 text-sm">Sign in to your Valen Grading account</p>
            </div>

            <form id="ajax-login-form" class="space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-white tracking-wide">Email</label>
                    <input type="email" name="email" required
                        class="w-full bg-[#1C1F22] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all placeholder-gray-600 hover:border-white/20"
                        placeholder="Enter your email">
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <label class="block text-sm font-semibold text-white tracking-wide">Password</label>
                        <a href="{{ route('password.request') }}" class="text-red-500 text-sm font-bold hover:text-red-400 transition-colors">Forgot password?</a>
                    </div>
                    <input type="password" name="password" required
                        class="w-full bg-[#1C1F22] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all placeholder-gray-600 hover:border-white/20"
                        placeholder="Enter your password">
                </div>

                <div id="login-error" class="hidden text-red-500 text-xs font-bold p-3 bg-red-500/10 rounded-lg border border-red-500/20"></div>

                <button type="submit" id="login-submit-btn" 
                    class="w-full bg-[#A3050A] text-white font-bold py-4 rounded-xl shadow-2xl shadow-red-900/20 transition-all hover:bg-red-700 hover:scale-[1.01] active:scale-[0.99] uppercase tracking-widest text-sm flex items-center justify-center gap-2">
                    <span id="btn-text">Sign In</span>
                    <svg id="loading-spinner" class="hidden w-5 h-5 animate-spin" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>

                <div class="text-center pt-4">
                    <p class="text-white text-sm font-semibold tracking-wide">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-red-500 hover:text-red-400 transition-colors underline ml-1">Sign Up</a>
                    </p>
                </div>
            </form>

            <!-- Close Button -->
            <button onclick="closeLoginModal()" class="absolute top-4 right-4 text-gray-500 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
    function openLoginModal() {
        document.getElementById('login-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeLoginModal() {
        document.getElementById('login-modal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    document.getElementById('ajax-login-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const form = e.target;
        const submitBtn = document.getElementById('login-submit-btn');
        const btnText = document.getElementById('btn-text');
        const spinner = document.getElementById('loading-spinner');
        const errorDiv = document.getElementById('login-error');
        
        // Reset state
        errorDiv.classList.add('hidden');
        submitBtn.disabled = true;
        btnText.textContent = 'Processing...';
        spinner.classList.remove('hidden');

        try {
            const formData = new FormData(form);
            const response = await fetch("{{ route('login') }}", {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok) {
                // Login successful handling
                // 1. Update CSRF tokens on the page to prevent 419 error
                if (data.csrf_token) {
                    const tokens = document.querySelectorAll('input[name="_token"]');
                    tokens.forEach(token => token.value = data.csrf_token);
                }

                // 2. Show Success State
                errorDiv.classList.add('hidden');
                document.getElementById('ajax-login-form').classList.add('opacity-0');
                
                const successDiv = document.createElement('div');
                successDiv.className = 'absolute inset-0 flex flex-col items-center justify-center text-center p-8 bg-[#15171A]';
                successDiv.innerHTML = `
                    <div class="w-16 h-16 bg-emerald-500/10 text-emerald-500 rounded-full flex items-center justify-center mb-4 border border-emerald-500/20">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Login Successful</h3>
                    <p class="text-gray-400 text-sm italic">Continuing your submission...</p>
                `;
                document.querySelector('#login-modal .relative').appendChild(successDiv);

                // 3. Proceed to submission after a short delay
                setTimeout(() => {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                        return;
                    }
                    
                    const mainForm = document.getElementById('cardForm');
                    if (mainForm) {
                        // Mark auth check as passed so our interceptor doesn't block it again
                        if (typeof authCheckPassed !== 'undefined') {
                            authCheckPassed = true;
                        }
                        closeLoginModal();
                        mainForm.submit();
                    } else {
                        window.location.reload();
                    }
                }, 1500);
            } else {
                // Show errors
                errorDiv.textContent = data.message || 'Verification failed. Please check your credentials.';
                errorDiv.classList.remove('hidden');
            }
        } catch (error) {
            errorDiv.textContent = 'An unexpected error occurred. Please try again.';
            errorDiv.classList.remove('hidden');
        } finally {
            submitBtn.disabled = false;
            btnText.textContent = 'Sign In';
            spinner.classList.add('hidden');
        }
    });
</script>
