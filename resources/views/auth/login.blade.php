<x-guest-layout>
    <!-- Header Section -->
    <div class="text-center mb-8">
        <div class="mx-auto h-16 w-16 flex items-center justify-center rounded-2xl bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg mb-6">
            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
        </div>
        <h2 class="text-3xl font-bold text-white mb-2">Welcome back</h2>
        <p class="text-white/80">Please sign in to your account</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <!-- Login Form -->
    <div class="space-y-6">
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email Address')" class="text-sm font-semibold text-white" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                    </svg>
                </div>
                <x-text-input id="email" 
                    class="block w-full pl-10 pr-3 py-3 border border-white/30 rounded-xl focus:ring-2 focus:ring-white/50 focus:border-white/50 transition-all duration-200 bg-white/10 hover:bg-white/20 focus:bg-white/25 backdrop-blur-sm text-white placeholder-white/60" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                    autocomplete="username"
                    placeholder="Enter your email address" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <x-input-label for="password" :value="__('Password')" class="text-sm font-semibold text-white" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <x-text-input id="password" 
                    class="block w-full pl-10 pr-3 py-3 border border-white/30 rounded-xl focus:ring-2 focus:ring-white/50 focus:border-white/50 transition-all duration-200 bg-white/10 hover:bg-white/20 focus:bg-white/25 backdrop-blur-sm text-white placeholder-white/60"
                    type="password"
                    name="password"
                    required 
                    autocomplete="current-password"
                    placeholder="Enter your password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex items-center group cursor-pointer">
                <input id="remember_me" 
                    type="checkbox" 
                    class="h-4 w-4 rounded border-white/30 text-indigo-400 bg-white/10 shadow-sm focus:ring-white/50 focus:ring-offset-0 transition-colors" 
                    name="remember">
                <span class="ml-3 text-sm text-white/80 group-hover:text-white transition-colors">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-white/80 hover:text-white font-medium transition-colors hover:underline" 
                   href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <x-primary-button class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-semibold text-white bg-white/20 hover:bg-white/30 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white/50 transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] border-white/30">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
                {{ __('Sign in to your account') }}
            </x-primary-button>
        </div>
    </form>
</div>

<!-- Footer -->
<div class="text-center mt-8">
    <p class="text-sm text-white/70">
        Don't have an account? 
        <a href={{ route('register') }} class="font-medium text-white hover:text-white/90 transition-colors hover:underline">
            Sign up here
        </a>
    </p>
</div>

<style>
    /* Custom animations and effects */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .space-y-6 > * {
        animation: slideIn 0.6s ease-out forwards;
    }

    .space-y-6 > *:nth-child(2) {
        animation-delay: 0.1s;
    }

    .space-y-6 > *:nth-child(3) {
        animation-delay: 0.2s;
    }

    .space-y-6 > *:nth-child(4) {
        animation-delay: 0.3s;
    }

    /* Enhanced focus states */
    input:focus {
        box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.2);
    }

    /* Hover effects for form fields */
    input[type="email"]:hover,
    input[type="password"]:hover {
        border-color: rgba(255, 255, 255, 0.5);
    }
</style>
</x-guest-layout>