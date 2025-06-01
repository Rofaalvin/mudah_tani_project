<x-guest-layout>
    <!-- Header Section -->
    <div class="text-center mb-8">
        <div class="mx-auto h-16 w-16 flex items-center justify-center rounded-2xl bg-gradient-to-r from-indigo-500 to-purple-600 shadow-lg mb-6">
            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
        </div>
        <h2 class="text-3xl font-bold text-white mb-2">Create Account</h2>
        <p class="text-white/80">Join us today and get started</p>
    </div>

    <!-- Register Form -->
    <div class="space-y-6">
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf
            
            <!-- Name -->
            <div class="space-y-2">
                <x-input-label for="name" :value="__('Full Name')" class="text-sm font-semibold text-white" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <x-text-input id="name" 
                        class="block w-full pl-10 pr-3 py-3 border border-white/30 rounded-xl focus:ring-2 focus:ring-white/50 focus:border-white/50 transition-all duration-200 bg-white/10 hover:bg-white/20 focus:bg-white/25 backdrop-blur-sm text-white placeholder-white/60" 
                        type="text" 
                        name="name" 
                        :value="old('name')" 
                        required 
                        autofocus 
                        autocomplete="name"
                        placeholder="Enter your full name" />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

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
                        autocomplete="new-password"
                        placeholder="Create a strong password" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="space-y-2">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-sm font-semibold text-white" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <x-text-input id="password_confirmation" 
                        class="block w-full pl-10 pr-3 py-3 border border-white/30 rounded-xl focus:ring-2 focus:ring-white/50 focus:border-white/50 transition-all duration-200 bg-white/10 hover:bg-white/20 focus:bg-white/25 backdrop-blur-sm text-white placeholder-white/60"
                        type="password"
                        name="password_confirmation"
                        required 
                        autocomplete="new-password"
                        placeholder="Confirm your password" />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <x-primary-button class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-semibold text-white bg-white/20 hover:bg-white/30 backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white/50 transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] border-white/30">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    {{ __('Create Account') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <!-- Footer -->
    <div class="text-center mt-8">
        <p class="text-sm text-white/70">
            Already have an account? 
            <a href="{{ route('login') }}" class="font-medium text-white hover:text-white/90 transition-colors hover:underline">
                Sign in here
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

        .space-y-6 > *:nth-child(5) {
            animation-delay: 0.4s;
        }

        .space-y-6 > *:nth-child(6) {
            animation-delay: 0.5s;
        }

        /* Enhanced focus states */
        input:focus {
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.2);
        }

        /* Hover effects for form fields */
        input[type="text"]:hover,
        input[type="email"]:hover,
        input[type="password"]:hover {
            border-color: rgba(255, 255, 255, 0.5);
        }
    </style>
</x-guest-layout>