@guest
<div id="loginModal" class="fixed inset-0 z-[9999] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/80 backdrop-blur-md transition-opacity opacity-0" id="loginModalBackdrop"></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-2xl bg-[#1C1E21] border border-white/10 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-sm opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" id="loginModalPanel">
            
            <!-- Close Button -->
            <div class="absolute right-0 top-0 pr-4 pt-4">
                <button type="button" class="rounded-md bg-transparent text-gray-400 hover:text-white focus:outline-none" onclick="closeLoginModal()">
                    <span class="sr-only">Close</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="px-6 py-8 sm:px-10">
                <div class="text-center mb-8">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[var(--color-primary)]/10 mb-4">
                        <svg class="h-8 w-8 text-[var(--color-primary)]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold leading-6 text-white" id="modal-title">Sign In Required</h3>
                    <p class="mt-2 text-sm text-gray-400">Please sign in to save your submission progress.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" id="loginForm" class="space-y-6">
                    @csrf
                    <!-- Add hidden input to redirect back to current page -->
                   <input type="hidden" name="redirect_to" value="{{ url()->current() }}">

                    <div>
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-300">Email address</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" autocomplete="email" required 
                                class="block w-full rounded-lg border-0 bg-[#15171A] py-3 text-white shadow-sm ring-1 ring-inset ring-white/10 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-[var(--color-primary)] sm:text-sm sm:leading-6 pl-4">
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-300">Password</label>
                            <div class="text-sm">
                                <a href="{{ route('password.request') }}" class="font-semibold text-[var(--color-primary)] hover:text-red-400">Forgot password?</a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <input id="password" name="password" type="password" autocomplete="current-password" required 
                                class="block w-full rounded-lg border-0 bg-[#15171A] py-3 text-white shadow-sm ring-1 ring-inset ring-white/10 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-[var(--color-primary)] sm:text-sm sm:leading-6 pl-4">
                        </div>
                    </div>

                    <div>
                        <button type="submit" id="loginBtn" class="flex w-full justify-center rounded-xl bg-[var(--color-primary)] px-3 py-3 text-sm font-bold leading-6 text-white shadow-sm hover:bg-[var(--color-primary-hover)] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[var(--color-primary)] transition-all duration-300 transform hover:scale-[1.02]">
                            Sign in
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center text-sm">
                    <p class="text-gray-400">
                        Not a member?
                        <a href="{{ route('register') }}" class="font-semibold text-[var(--color-primary)] hover:text-red-400">Register</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openLoginModal() {
        const modal = document.getElementById('loginModal');
        const backdrop = document.getElementById('loginModalBackdrop');
        const panel = document.getElementById('loginModalPanel');
        
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden'); // Lock scroll
        
        // Animation
        setTimeout(() => {
            backdrop.classList.remove('opacity-0');
            panel.classList.remove('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
            panel.classList.add('opacity-100', 'translate-y-0', 'sm:scale-100');
        }, 10);
    }

    function closeLoginModal() {
        const modal = document.getElementById('loginModal');
        const backdrop = document.getElementById('loginModalBackdrop');
        const panel = document.getElementById('loginModalPanel');
        
        backdrop.classList.add('opacity-0');
        panel.classList.remove('opacity-100', 'translate-y-0', 'sm:scale-100');
        panel.classList.add('opacity-0', 'translate-y-4', 'sm:translate-y-0', 'sm:scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden'); // Unlock scroll
        }, 300);
    }

    // Close on click outside
    document.getElementById('loginModal').addEventListener('click', function(e) {
        if (e.target === this || e.target.closest('#loginModalBackdrop')) {
            closeLoginModal();
        }
    });

    // Handle AJAX Login
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const btn = document.getElementById('loginBtn');
        const originalText = btn.innerHTML;
        btn.innerHTML = 'Signing in...';
        btn.disabled = true;

        const formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.errors) {
                // Handle errors (display them)
                alert('Login failed. Please check your credentials.'); // Simple alert for now, can be improved
                btn.innerHTML = originalText;
                btn.disabled = false;
            } else {
                // Success
                window.authCheckPassed = true; // Set flag for parent form
                closeLoginModal();

                // Update all CSRF tokens on the page with the new one
                if (data.csrf_token) {
                    document.querySelectorAll('input[name="_token"]').forEach(input => {
                        input.value = data.csrf_token;
                    });
                    
                    // Also update the meta tag for future fetch requests
                    const metaToken = document.querySelector('meta[name="csrf-token"]');
                    if (metaToken) {
                        metaToken.setAttribute('content', data.csrf_token);
                    }
                }
                
                // If there's a parent form waiting to submit (like in step 3), submit it
                const cardForm = document.getElementById('cardForm');
                if (cardForm) {
                    cardForm.submit();
                } else {
                    window.location.reload();
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            btn.innerHTML = originalText;
            btn.disabled = false;
            // Optionally try standard submission if ajax fails
             this.submit();
        });
    });
</script>
@endguest
