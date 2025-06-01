<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Custom font family */
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Gradient animations */
        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .animated-gradient {
            background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #f5576c, #4facfe, #00f2fe);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }

        /* Floating animation for decorative elements */
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        /* Glassmorphism utilities */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Particle effect overlay */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: particleFloat 20s linear infinite;
        }

        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) scale(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) scale(1);
                opacity: 0;
            }
        }

        /* Enhanced focus states */
        .focus-enhanced:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="antialiased overflow-x-hidden">
    <!-- Animated Background -->
    <div class="fixed inset-0 animated-gradient">
        <!-- Particle Effects -->
        <div class="particles">
            <div class="particle" style="left: 10%; width: 4px; height: 4px; animation-delay: 0s;"></div>
            <div class="particle" style="left: 20%; width: 6px; height: 6px; animation-delay: 2s;"></div>
            <div class="particle" style="left: 30%; width: 3px; height: 3px; animation-delay: 4s;"></div>
            <div class="particle" style="left: 40%; width: 5px; height: 5px; animation-delay: 6s;"></div>
            <div class="particle" style="left: 50%; width: 4px; height: 4px; animation-delay: 8s;"></div>
            <div class="particle" style="left: 60%; width: 6px; height: 6px; animation-delay: 10s;"></div>
            <div class="particle" style="left: 70%; width: 3px; height: 3px; animation-delay: 12s;"></div>
            <div class="particle" style="left: 80%; width: 5px; height: 5px; animation-delay: 14s;"></div>
            <div class="particle" style="left: 90%; width: 4px; height: 4px; animation-delay: 16s;"></div>
        </div>
        
        <!-- Decorative Shapes -->
        <div class="absolute top-20 left-10 w-32 h-32 bg-white/10 rounded-full blur-xl floating"></div>
        <div class="absolute bottom-20 right-10 w-48 h-48 bg-purple-300/20 rounded-full blur-2xl floating" style="animation-delay: -3s;"></div>
        <div class="absolute top-1/2 left-1/4 w-24 h-24 bg-blue-300/15 rounded-full blur-lg floating" style="animation-delay: -1s;"></div>
        <div class="absolute top-1/3 right-1/4 w-40 h-40 bg-pink-300/10 rounded-full blur-xl floating" style="animation-delay: -2s;"></div>
    </div>

    <!-- Main Content -->
    <div class="relative min-h-screen flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8">
        <!-- Logo Section -->
        <div class="text-center mb-8">
            <a href="/" class="inline-block group">
                <div class="relative">
                    <!-- Animated logo background -->
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl blur-lg opacity-60 group-hover:opacity-80 transition-opacity duration-300"></div>
                    
                    <!-- Logo container -->
                    <div class="relative bg-white/90 backdrop-blur-sm rounded-2xl p-4 shadow-2xl group-hover:shadow-3xl transition-all duration-300 transform group-hover:scale-105">
                        <x-application-logo class="w-16 h-16 fill-current text-gray-700" />
                    </div>
                </div>
            </a>
            
            <!-- App name -->
            <h1 class="mt-4 text-2xl font-bold text-white/90">
                {{ config('app.name', 'Laravel') }}
            </h1>
        </div>

        <!-- Content Card -->
        <div class="w-full max-w-md">
            <div class="glass rounded-3xl shadow-2xl p-8 backdrop-blur-lg border border-white/30">
                {{ $slot }}
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-12 text-center">
            <p class="text-white/70 text-sm">
                © {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
            </p>
            <div class="mt-2 flex justify-center space-x-4 text-xs text-white/60">
                <a href="#" class="hover:text-white/90 transition-colors">Privacy Policy</a>
                <span>•</span>
                <a href="#" class="hover:text-white/90 transition-colors">Terms of Service</a>
                <span>•</span>
                <a href="#" class="hover:text-white/90 transition-colors">Support</a>
            </div>
        </div>
    </div>

    <script>
        // Add dynamic particle generation
        function createParticle() {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.width = (Math.random() * 6 + 2) + 'px';
            particle.style.height = particle.style.width;
            particle.style.animationDelay = '0s';
            particle.style.animationDuration = (Math.random() * 10 + 15) + 's';
            
            const particles = document.querySelector('.particles');
            particles.appendChild(particle);
            
            // Remove particle after animation
            setTimeout(() => {
                if (particle.parentNode) {
                    particle.parentNode.removeChild(particle);
                }
            }, 25000);
        }

        // Generate particles periodically
        setInterval(createParticle, 3000);

        // Add subtle mouse movement parallax effect
        document.addEventListener('mousemove', (e) => {
            const shapes = document.querySelectorAll('.floating');
            const mouseX = (e.clientX / window.innerWidth) - 0.5;
            const mouseY = (e.clientY / window.innerHeight) - 0.5;
            
            shapes.forEach((shape, index) => {
                const speed = (index + 1) * 0.5;
                const x = mouseX * speed * 20;
                const y = mouseY * speed * 20;
                
                shape.style.transform = `translate(${x}px, ${y}px)`;
            });
        });
    </script>
</body>
</html>