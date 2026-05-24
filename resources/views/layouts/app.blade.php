<!DOCTYPE html>
<html lang="en" class="h-full bg-[#020203] text-[#F4F4F5] scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Lifedrop - Every Drop Counts')</title>
    
    <!-- Meta tags for SEO -->
    <meta name="description" content="Lifedrop is a trusted, modern, and rapid blood donor and emergency request matching system. Register to save a life, or search for blood instantly.">
    <meta name="keywords" content="blood donor, find blood group, blood transfusion, emergency blood, lifedrop">
    <meta name="author" content="Lifedrop Organisation">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles and Vite compilation -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

    <style>
        body {
            font-family: 'Inter', 'Poppins', sans-serif;
        }
        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }
        /* Custom Glowing Availability Animations */
        @keyframes custom-pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
            }
            50% {
                transform: scale(1.1);
                opacity: 0.8;
                box-shadow: 0 0 0 6px rgba(239, 68, 68, 0);
            }
        }
        .glowing-dot-active {
            animation: custom-pulse 2s infinite;
        }
        /* Glassmorphism Classes */
        .glass-nav {
            background: rgba(9, 9, 11, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body class="flex flex-col h-full bg-[#020203] text-[#F4F4F5] antialiased min-h-screen relative overflow-x-hidden selection:bg-red-500/30 selection:text-red-200">

    <!-- Header Navigation -->
    <header class="sticky top-0 z-40 w-full glass-nav">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Branding / Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                        <!-- Blood Drop SVG Icon -->
                        <div class="relative flex items-center justify-center w-9 h-9 bg-red-950/40 rounded-xl border border-red-900/30 transition-all duration-300 group-hover:bg-red-900/30">
                            <svg class="w-6 h-6 text-red-500 fill-current transform transition-transform duration-300 group-hover:scale-110" viewBox="0 0 24 24">
                                <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z" />
                            </svg>
                            <span class="absolute w-2 h-2 bg-red-400 rounded-full top-2 right-2 glowing-dot-active"></span>
                        </div>
                        <span class="text-xl font-bold tracking-tight font-poppins text-[#F4F4F5]">
                            life<span class="text-red-500">drop</span>
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <nav class="hidden md:flex items-center space-x-8 text-sm font-medium">
                    <a href="{{ route('home') }}" class="text-zinc-400 hover:text-red-500 transition-colors py-2 {{ request()->routeIs('home') ? 'border-b-2 border-red-500 text-red-500' : '' }}">Home</a>
                    <a href="{{ route('search') }}" class="text-zinc-400 hover:text-red-500 transition-colors py-2 {{ request()->routeIs('search') ? 'border-b-2 border-red-500 text-red-500' : '' }}">Find Donors</a>
                    <a href="{{ route('requests.index') }}" class="text-zinc-400 hover:text-red-500 transition-colors py-2 {{ request()->routeIs('requests.*') && !request()->routeIs('requests.create') ? 'border-b-2 border-red-500 text-red-500' : '' }}">Requests Feed</a>
                </nav>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    @auth
                        <div class="hidden md:flex items-center space-x-4">
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.index') }}" class="px-3 py-1.5 text-xs font-semibold text-red-400 bg-red-950/30 border border-red-900/55 rounded-lg hover:bg-red-900/40 hover:text-red-300 transition-all">
                                    Admin Board
                                </a>
                            @endif
                            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 text-sm font-medium text-zinc-300 hover:text-red-500 transition-colors">
                                @if(auth()->user()->avatar)
                                    <img class="w-8 h-8 rounded-full border border-zinc-800 object-cover" src="{{ asset(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
                                @else
                                    <div class="w-8 h-8 rounded-full bg-red-950/40 flex items-center justify-center font-bold text-red-500 border border-red-900/40">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                    </div>
                                @endif
                                <span class="max-w-[100px] truncate">{{ auth()->user()->name }}</span>
                            </a>
                        </div>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-sm font-medium text-zinc-400 bg-zinc-900/50 hover:bg-zinc-800/85 border border-zinc-800 rounded-xl transition-all">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-zinc-400 hover:text-red-500 transition-all">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 rounded-xl shadow-lg shadow-red-950/40 hover:shadow-red-900/30 transition-all border border-red-500/20">
                            Join as Donor
                        </a>
                    @endauth

                    <!-- Sticky Urgency Button -->
                    <a href="{{ route('requests.create') }}" class="hidden sm:inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-zinc-900 border border-zinc-800 hover:bg-zinc-800 rounded-xl transition-all shadow-lg hover:border-red-900/40">
                        <svg class="w-4 h-4 mr-2 animate-bounce text-red-500 fill-current" viewBox="0 0 24 24">
                            <path d="M12 2L1 21h22L12 2zm0 14h-2v-2h2v2zm0-4h-2V8h2v4z" />
                        </svg>
                        Report a Crisis
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Success and Error Toast Notifications -->
    <div class="fixed bottom-5 right-5 z-50 flex flex-col space-y-3 max-w-sm w-full">
        @if (session('success'))
            <div id="toast-success" class="flex items-center w-full p-4 text-zinc-200 bg-zinc-950/90 backdrop-blur-md rounded-2xl shadow-2xl border border-emerald-950/60 shadow-emerald-950/10 animate-slide-in-right" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-emerald-400 bg-emerald-950/50 border border-emerald-900/40 rounded-xl">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 1 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                </div>
                <div class="ml-3 text-sm font-medium">{{ session('success') }}</div>
                <button type="button" onclick="document.getElementById('toast-success').remove()" class="ml-auto -mx-1.5 -my-1.5 text-zinc-500 hover:text-zinc-300 rounded-lg p-1.5 hover:bg-zinc-900 inline-flex items-center justify-center h-8 w-8 transition-colors">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div id="toast-error" class="flex items-center w-full p-4 text-zinc-200 bg-zinc-950/90 backdrop-blur-md rounded-2xl shadow-2xl border border-red-950/60 shadow-red-950/10 animate-slide-in-right" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-400 bg-red-950/50 border border-red-900/40 rounded-xl">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm1 14H9v-2h2v2Zm0-4H9V5h2v6Z"/>
                    </svg>
                </div>
                <div class="ml-3 text-sm font-medium">{{ session('error') }}</div>
                <button type="button" onclick="document.getElementById('toast-error').remove()" class="ml-auto -mx-1.5 -my-1.5 text-zinc-500 hover:text-zinc-300 rounded-lg p-1.5 hover:bg-zinc-900 inline-flex items-center justify-center h-8 w-8 transition-colors">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer Space -->
    <footer class="bg-[#050507] text-[#A1A1AA] border-t border-zinc-900 py-12 mt-auto relative z-10">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Branding -->
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="flex items-center justify-center w-8 h-8 bg-red-950/40 rounded-xl border border-red-900/30">
                            <svg class="w-5 h-5 text-red-500 fill-current" viewBox="0 0 24 24">
                                <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z" />
                            </svg>
                        </div>
                        <span class="text-lg font-bold text-white font-poppins">life<span class="text-red-500">drop</span></span>
                    </div>
                    <p class="text-sm text-zinc-400 max-w-sm">
                        A single drop of blood can rewrite someone's future. Connecting local emergency seekers with altruistic donors instantly, securely, and transparently.
                    </p>
                </div>
                <!-- Links -->
                <div>
                    <h3 class="text-white text-sm font-semibold tracking-wider uppercase mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home Landing</a></li>
                        <li><a href="{{ route('search') }}" class="hover:text-white transition-colors">Find Blood Donors</a></li>
                        <li><a href="{{ route('requests.index') }}" class="hover:text-white transition-colors">Crisis Requests</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">Join as Donor</a></li>
                    </ul>
                </div>
                <!-- Preservation Checklist -->
                <div>
                    <h3 class="text-white text-sm font-semibold tracking-wider uppercase mb-4">Preservation Rules</h3>
                    <ul class="space-y-2 text-xs">
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-red-500 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Age 18 to 65 Years
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-red-500 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Weight Above 50 kg
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-red-500 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            90-Day Cooldown Cooldown
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-zinc-900 mt-8 pt-8 flex flex-col md:flex-row items-center justify-between text-xs">
                <p>&copy; {{ date('Y') }} Lifedrop Platform. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <span class="text-xs text-red-500 font-semibold flex items-center">
                        <span class="w-2.5 h-2.5 bg-red-500 rounded-full glowing-dot-active mr-2"></span>
                        Active Protection Network
                    </span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Biotech 3D WebGL Animation Canvas -->
    <canvas id="biotech-3d-canvas" class="fixed inset-0 pointer-events-none z-0 opacity-45"></canvas>
    
    <script>
        // Three.js 3D Biotech WebGL Engine
        (function() {
            const canvas = document.getElementById('biotech-3d-canvas');
            if (!canvas) return;

            // WebGL Renderer Setup
            const renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true });
            renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
            renderer.setSize(window.innerWidth, window.innerHeight);

            // Perspective Camera
            const camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 100);
            camera.position.z = 12;

            // Scene Graph
            const scene = new THREE.Scene();

            // Biotech Ambient & Point Lighting (Crimson/Purple dual tone)
            const ambientLight = new THREE.AmbientLight(0x18181b, 1.8);
            scene.add(ambientLight);

            const crimsonLight = new THREE.PointLight(0xef4444, 4.0, 30);
            crimsonLight.position.set(10, 10, 8);
            scene.add(crimsonLight);

            const purpleLight = new THREE.PointLight(0x8b5cf6, 4.0, 30);
            purpleLight.position.set(-10, -10, 8);
            scene.add(purpleLight);

            // Interactive DNA Double-Helix Group
            const dnaGroup = new THREE.Group();
            scene.add(dnaGroup);

            const dnaScale = 0.58;
            dnaGroup.scale.set(dnaScale, dnaScale, dnaScale);

            function updateDnaPosition() {
                if (window.innerWidth < 768) {
                    dnaGroup.position.set(0, 0, 0);
                } else {
                    dnaGroup.position.set(4, 0, 0);
                }
            }
            updateDnaPosition();

            const nodeGeometry = new THREE.SphereGeometry(0.18, 16, 16);
            const material1 = new THREE.MeshPhongMaterial({
                color: 0xef4444,
                emissive: 0x3f0000,
                specular: 0xffffff,
                shininess: 50
            });
            const material2 = new THREE.MeshPhongMaterial({
                color: 0x8b5cf6,
                emissive: 0x1f003f,
                specular: 0xffffff,
                shininess: 50
            });
            const bridgeMaterial = new THREE.MeshPhongMaterial({
                color: 0x3f3f46,
                specular: 0x666666,
                shininess: 25,
                transparent: true,
                opacity: 0.7
            });

            const numNodes = 40;
            const helixRadius = 1.6;
            const helixHeight = 15;
            const turns = 3;

            for (let i = 0; i < numNodes; i++) {
                const t = (i / numNodes) * Math.PI * 2 * turns;
                const y = (i / numNodes) * helixHeight - (helixHeight / 2);

                // Strand 1
                const x1 = Math.cos(t) * helixRadius;
                const z1 = Math.sin(t) * helixRadius;
                const sphere1 = new THREE.Mesh(nodeGeometry, material1);
                sphere1.position.set(x1, y, z1);
                dnaGroup.add(sphere1);

                // Strand 2
                const x2 = Math.cos(t + Math.PI) * helixRadius;
                const z2 = Math.sin(t + Math.PI) * helixRadius;
                const sphere2 = new THREE.Mesh(nodeGeometry, material2);
                sphere2.position.set(x2, y, z2);
                dnaGroup.add(sphere2);

                // Connecting Bridges
                if (i % 2 === 0) {
                    const distance = helixRadius * 2;
                    const bridgeGeom = new THREE.CylinderGeometry(0.04, 0.04, distance, 8);
                    const bridge = new THREE.Mesh(bridgeGeom, bridgeMaterial);
                    bridge.position.set((x1 + x2) / 2, y, (z1 + z2) / 2);
                    bridge.rotation.z = -t;
                    dnaGroup.add(bridge);
                }
            }

            // Floating Red Blood Cells (Erythrocytes) Group
            const rbcGroup = new THREE.Group();
            scene.add(rbcGroup);

            const rbcGeometry = new THREE.TorusGeometry(0.42, 0.22, 16, 32);
            const rbcMaterial = new THREE.MeshPhongMaterial({
                color: 0xdc2626,
                emissive: 0x4f0505,
                specular: 0xffaa88,
                shininess: 65
            });

            const cells = [];
            const cellCount = 18;

            function resetCell(cell) {
                cell.position.x = (Math.random() - 0.5) * 16;
                cell.position.y = -10 - Math.random() * 5;
                cell.position.z = (Math.random() - 0.5) * 8 - 2;

                cell.userData = {
                    speedY: Math.random() * 0.02 + 0.012,
                    speedX: (Math.random() - 0.5) * 0.008,
                    rotSpeedX: Math.random() * 0.015 - 0.007,
                    rotSpeedY: Math.random() * 0.015 - 0.007,
                    rotSpeedZ: Math.random() * 0.015 - 0.007,
                    pulseOffset: Math.random() * Math.PI * 2
                };

                cell.rotation.set(
                    Math.random() * Math.PI,
                    Math.random() * Math.PI,
                    Math.random() * Math.PI
                );
            }

            for (let i = 0; i < cellCount; i++) {
                const cell = new THREE.Mesh(rbcGeometry, rbcMaterial);
                cell.scale.set(1, 1, 0.38); // Squashed along Z to create biconcave shape
                resetCell(cell);
                cell.position.y = (Math.random() - 0.5) * 16; // Disperse initially
                rbcGroup.add(cell);
                cells.push(cell);
            }

            // Parallax mouse movements
            let targetMouseX = 0, targetMouseY = 0;
            let mouseX = 0, mouseY = 0;
            let targetScrollY = 0;
            let scrollY = 0;

            window.addEventListener('mousemove', (e) => {
                targetMouseX = (e.clientX - window.innerWidth / 2) / (window.innerWidth / 2);
                targetMouseY = (e.clientY - window.innerHeight / 2) / (window.innerHeight / 2);
            });

            window.addEventListener('scroll', () => {
                targetScrollY = window.scrollY;
            });

            window.addEventListener('resize', () => {
                camera.aspect = window.innerWidth / window.innerHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(window.innerWidth, window.innerHeight);
                updateDnaPosition();
            });

            // Physics/Animation Loop
            function animate(time) {
                requestAnimationFrame(animate);

                // Rotate Helix
                dnaGroup.rotation.y += 0.005;
                dnaGroup.rotation.x = Math.sin(time * 0.0003) * 0.06;

                // Move and spin blood cells
                cells.forEach(cell => {
                    cell.position.y += cell.userData.speedY;
                    cell.position.x += cell.userData.speedX + Math.sin(time * 0.001 + cell.userData.pulseOffset) * 0.003;
                    
                    cell.rotation.x += cell.userData.rotSpeedX;
                    cell.rotation.y += cell.userData.rotSpeedY;
                    cell.rotation.z += cell.userData.rotSpeedZ;

                    // Recenter cell if it floats above top bounds
                    if (cell.position.y > 10) {
                        resetCell(cell);
                    }
                });

                // Smooth Parallax Lerp
                mouseX += (targetMouseX - mouseX) * 0.05;
                mouseY += (targetMouseY - mouseY) * 0.05;

                camera.position.x += (mouseX * 2.5 - camera.position.x) * 0.05;
                camera.position.y += (-mouseY * 2.5 - camera.position.y) * 0.05;

                // Smooth Scroll Integration
                scrollY += (targetScrollY - scrollY) * 0.06;
                const maxScroll = document.documentElement.scrollHeight - window.innerHeight || 1;
                const scrollPercent = scrollY / maxScroll;
                
                // Slightly translate camera downward on scroll
                camera.position.y -= scrollPercent * 3.5;

                camera.lookAt(scene.position);

                renderer.render(scene, camera);
            }

            animate(0);
        })();

        // 3D CSS Card Tilt Interaction
        (function() {
            function init3dTilt() {
                const tiltElements = document.querySelectorAll('.tilt-3d');
                tiltElements.forEach(el => {
                    if (el.dataset.tiltInitialized) return;
                    el.dataset.tiltInitialized = 'true';

                    el.style.transition = 'transform 0.15s ease-out, box-shadow 0.25s ease-out';
                    el.style.transformStyle = 'preserve-3d';
                    
                    el.addEventListener('mousemove', (e) => {
                        const rect = el.getBoundingClientRect();
                        const x = e.clientX - rect.left;
                        const y = e.clientY - rect.top;
                        const xc = rect.width / 2;
                        const yc = rect.height / 2;
                        
                        // Premium tilt range of max 7 degrees
                        const tiltX = (yc - y) / (yc / 7);
                        const tiltY = (x - xc) / (xc / 7);
                        
                        el.style.transform = `perspective(1000px) rotateX(${tiltX}deg) rotateY(${tiltY}deg) scale3d(1.03, 1.03, 1.03)`;
                        el.style.boxShadow = '0 25px 50px -12px rgba(239, 68, 68, 0.25), 0 0 35px 2px rgba(139, 92, 246, 0.14)';
                    });
                    
                    el.addEventListener('mouseleave', () => {
                        el.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)';
                        el.style.boxShadow = '';
                    });
                });
            }

            init3dTilt();

            // Observe dynamic elements
            const observer = new MutationObserver(init3dTilt);
            observer.observe(document.body, { childList: true, subtree: true });
        })();

        // Toast auto-removal helper
        setTimeout(() => {
            const toastS = document.getElementById('toast-success');
            if (toastS) {
                toastS.style.opacity = '0';
                toastS.style.transition = 'opacity 0.5s ease';
                setTimeout(() => toastS.remove(), 500);
            }
            const toastE = document.getElementById('toast-error');
            if (toastE) {
                toastE.style.opacity = '0';
                toastE.style.transition = 'opacity 0.5s ease';
                setTimeout(() => toastE.remove(), 500);
            }
        }, 5000);
    </script>
</body>
</html>
