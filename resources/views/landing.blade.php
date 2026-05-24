@extends('layouts.app')

@section('title', 'Lifedrop - A Single Drop Can Rewrite a Future')

@section('content')
<!-- Hero Space -->
<style>
    /* Scroll Reveal Transition styling */
    .reveal-section {
        opacity: 0;
        transform: translateY(35px);
        transition: all 1.0s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .reveal-section.revealed {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Compatibility Card Hover transitions */
    .compat-card {
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .compat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 20px -5px rgba(239, 68, 68, 0.15);
        border-color: rgba(239, 68, 68, 0.4) !important;
    }

    /* O- Highlight custom style */
    .compat-card.highlight-o-minus {
        box-shadow: 0 0 20px 2px rgba(239, 68, 68, 0.2) !important;
        border-color: rgba(239, 68, 68, 0.6) !important;
        background: rgba(220, 38, 38, 0.08) !important;
    }
    .compat-card.highlight-o-minus:hover {
        box-shadow: 0 0 25px 5px rgba(239, 68, 68, 0.3) !important;
    }

    /* AB+ Highlight custom style */
    .compat-card.highlight-ab-plus {
        box-shadow: 0 0 20px 2px rgba(139, 92, 246, 0.2) !important;
        border-color: rgba(139, 92, 246, 0.6) !important;
        background: rgba(139, 92, 246, 0.08) !important;
    }
    .compat-card.highlight-ab-plus:hover {
        box-shadow: 0 0 25px 5px rgba(139, 92, 246, 0.3) !important;
    }

    /* Glow ring on hover */
    .glow-hover {
        transition: all 0.3s ease;
    }
    .glow-hover:hover {
        box-shadow: 0 0 15px 3px rgba(239, 68, 68, 0.4);
    }
</style>

<section class="relative overflow-hidden bg-gradient-to-b from-[#020203] via-[#09090B] to-[#020203] pt-24 pb-16">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 text-center relative z-10">
        <!-- Urgent Notice Badge -->
        <div class="inline-flex items-center px-3 py-1 mb-6 text-xs font-semibold text-red-400 bg-red-950/30 border border-red-900/40 rounded-full animate-pulse-slow">
            <span class="w-2 h-2 mr-2 bg-red-500 rounded-full glowing-dot-active"></span>
            Critical Demand: O- and B- Needed Globally
        </div>
        
        <h1 class="text-4xl font-extrabold tracking-tight text-zinc-100 sm:text-5xl md:text-6xl font-poppins max-w-4xl mx-auto leading-tight">
            A single drop of blood can <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-red-600">rewrite someone's future.</span>
        </h1>
        
        <p class="max-w-2xl mx-auto mt-6 text-base text-zinc-400 sm:text-lg">
            Every second counts in medical crises. Lifedrop connects patients in urgent need with real-time, matching blood donors in their immediate vicinity.
        </p>

        <!-- Prominent Call to Action Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-10">
            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 text-base font-semibold text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 rounded-2xl shadow-lg shadow-red-950/40 hover:shadow-red-900/30 transition-all flex items-center justify-center group border border-red-500/20 glow-hover">
                Register as a Donor
                <svg class="w-5 h-5 ml-2 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
            <a href="#search-fold" class="w-full sm:w-auto px-8 py-4 text-base font-semibold text-red-400 bg-zinc-950/50 hover:bg-zinc-900/80 border border-red-500/30 rounded-2xl transition-all flex items-center justify-center">
                Find Blood Instantly
            </a>
        </div>
    </div>
    
    <!-- Abstract dark graphics in background -->
    <div class="absolute top-0 left-1/2 -z-10 h-[600px] w-[800px] -translate-x-1/2 stroke-zinc-900 [mask-image:radial-gradient(600px_600px_at_center,white,transparent)]">
        <svg class="h-full w-full opacity-15" fill="none" viewBox="0 0 80 80">
            <defs>
                <pattern id="grid" width="20" height="20" patternUnits="userSpaceOnUse">
                    <rect width="20" height="20" fill="none" stroke="#27272a" stroke-width="0.5" />
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#grid)" />
        </svg>
    </div>
</section>

<!-- Sticky/Horizontal Search Widget Fold -->
<section id="search-fold" class="relative -mt-6 z-20 px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 reveal-section">
    <div class="bg-zinc-900/60 backdrop-blur-md border border-zinc-800/80 rounded-3xl shadow-2xl p-6 md:p-8 tilt-3d">
        <h2 class="text-lg font-bold font-poppins text-zinc-200 mb-4 flex items-center">
            <span class="w-2 h-4 bg-red-500 rounded-full mr-2"></span>
            Instant Emergency Search Widget
        </h2>
        
        <form method="GET" action="{{ route('search') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <!-- Blood Group Selector -->
            <div>
                <label for="blood_group" class="block text-xs font-semibold text-zinc-400 uppercase tracking-wider mb-2">Blood Group</label>
                <div class="relative">
                    <select name="blood_group" id="blood_group" class="block w-full px-4 py-3.5 bg-zinc-950 border border-zinc-800 text-zinc-200 focus:ring-red-500/30 focus:border-red-500 text-sm appearance-none cursor-pointer rounded-xl focus:outline-none">
                        <option value="">Select Blood Group (Any)</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-zinc-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
            </div>

            <!-- City / District -->
            <div>
                <label for="city" class="block text-xs font-semibold text-zinc-400 uppercase tracking-wider mb-2">Select City/District</label>
                <div class="relative">
                    <input type="text" name="city" id="city" placeholder="e.g. New York, Chicago" class="block w-full px-4 py-3.5 bg-zinc-950 border border-zinc-800 text-zinc-200 focus:ring-red-500/30 focus:border-red-500 text-sm pl-10 rounded-xl focus:outline-none">
                    <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-zinc-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                </div>
            </div>

            <!-- Search Button -->
            <div>
                <button type="submit" class="w-full px-6 py-4 text-sm font-semibold text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 rounded-xl shadow-lg shadow-red-950/40 border border-red-500/20 transition-all flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Search Donors
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Motivation Block (Statistics) -->
<section class="py-16 bg-[#020203]/40 border-t border-zinc-900/50 reveal-section">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Metric Card 1 -->
            <div class="flex items-center p-6 bg-zinc-900/40 backdrop-blur-sm border border-zinc-800/50 rounded-2xl hover:border-zinc-700/60 transition-all tilt-3d">
                <div class="w-14 h-14 bg-red-950/30 rounded-xl flex items-center justify-center text-red-400 border border-red-900/40 mr-4">
                    <svg class="w-7 h-7 fill-current" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </div>
                <div>
                    <span class="block text-3xl font-extrabold font-poppins text-zinc-100">{{ $donorsCount }}</span>
                    <span class="text-sm font-medium text-zinc-400">Active Donors Registered</span>
                </div>
            </div>

            <!-- Metric Card 2 -->
            <div class="flex items-center p-6 bg-zinc-900/40 backdrop-blur-sm border border-zinc-800/50 rounded-2xl hover:border-zinc-700/60 transition-all tilt-3d">
                <div class="w-14 h-14 bg-red-950/30 rounded-xl flex items-center justify-center text-red-400 border border-red-900/40 mr-4">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div>
                    <span class="block text-3xl font-extrabold font-poppins text-zinc-100">{{ $livesSaved }}</span>
                    <span class="text-sm font-medium text-zinc-400">Emergency Lives Saved</span>
                </div>
            </div>

            <!-- Metric Card 3 -->
            <div class="flex items-center p-6 bg-zinc-900/40 backdrop-blur-sm border border-zinc-800/50 rounded-2xl hover:border-zinc-700/60 transition-all tilt-3d">
                <div class="w-14 h-14 bg-red-950/30 rounded-xl flex items-center justify-center text-red-400 border border-red-900/40 mr-4">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <span class="block text-3xl font-extrabold font-poppins text-zinc-100">{{ $hospitalsCount }}</span>
                    <span class="text-sm font-medium text-zinc-400">Hospitals Partnered</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Urgent Requests Highlights -->
@if($urgentRequests->count() > 0)
<section class="py-12 bg-[#09090B]/60 border-y border-zinc-900/80 reveal-section">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8">
            <div>
                <span class="text-xs font-semibold text-red-400 uppercase tracking-wider">Altruistic Action Feed</span>
                <h2 class="text-2xl font-bold font-poppins text-zinc-100 mt-1">Live Crisis Board Preview</h2>
            </div>
            <a href="{{ route('requests.index') }}" class="text-sm font-semibold text-red-400 hover:text-red-300 hover:underline mt-2 md:mt-0 flex items-center">
                View All Crisis Requests
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($urgentRequests as $req)
                <div class="bg-zinc-900/60 backdrop-blur-md border border-zinc-800/80 rounded-2xl p-6 shadow-lg hover:border-zinc-700/50 transition-all relative tilt-3d">
                    <!-- Urgent Indicator -->
                    @if($req->urgency === 'urgent')
                        <span class="absolute top-4 right-4 px-2 py-0.5 text-[10px] font-bold text-red-400 bg-red-950/60 border border-red-900/40 rounded-full uppercase">CRITICAL</span>
                    @endif

                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-12 h-12 bg-red-950/40 text-red-400 border border-red-900/40 rounded-xl flex items-center justify-center text-lg font-bold">
                            {{ $req->blood_group }}
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-zinc-200 truncate max-w-[150px]">Patient: {{ $req->patient_name }}</h3>
                            <p class="text-xs text-zinc-400">Needed: <span class="font-semibold text-zinc-300">{{ $req->units }} Unit{{ $req->units > 1 ? 's' : '' }}</span></p>
                        </div>
                    </div>
                    
                    <div class="space-y-2 text-xs text-zinc-400 mb-6">
                        <p class="flex items-start">
                            <svg class="w-4 h-4 text-zinc-500 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            <span class="truncate">{{ $req->hospital_name }}</span>
                        </p>
                        <p class="flex items-start">
                            <svg class="w-4 h-4 text-zinc-500 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>{{ $req->city }}</span>
                        </p>
                    </div>

                    <a href="{{ route('requests.index') }}" class="block w-full py-2 text-center text-xs font-semibold text-red-400 bg-red-950/30 border border-red-900/40 hover:bg-red-900/40 text-red-400 hover:text-red-300 rounded-xl transition-all">
                        Respond on Requests Board
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Educational Section (Why Donate?) -->
<section class="py-20 bg-transparent border-t border-zinc-900/80 reveal-section">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        
        <!-- MOTIVATION HEADER & CARD GRID -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold text-red-400 uppercase tracking-wider bg-red-950/40 border border-red-900/30 px-3 py-1 rounded-full">Altruism & Urgency</span>
            <h2 class="text-3xl font-extrabold font-poppins text-zinc-100 mt-3">The Power of Your Donation</h2>
            <p class="text-sm text-zinc-400 mt-3 leading-relaxed">
                A single decision can create a massive ripple effect in someone's life. Here are the core motives why blood donation is a direct lifeline for families in crisis.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-24">
            <!-- Motivation Card 1 -->
            <div class="bg-zinc-900/50 backdrop-blur-sm border border-zinc-800/80 rounded-3xl p-8 hover:border-red-950/40 hover:shadow-red-950/5 transition-all duration-300 group tilt-3d">
                <div class="w-12 h-12 bg-red-950/30 rounded-2xl flex items-center justify-center text-red-400 border border-red-900/40 mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-lg font-bold font-poppins text-zinc-200 mb-3">Every 2 Seconds</h3>
                <p class="text-xs text-zinc-400 leading-relaxed">
                    Someone in the world requires blood transfusion due to surgeries, chronic illnesses, cancer treatments, or severe trauma. The clock never stops.
                </p>
            </div>

            <!-- Motivation Card 2 -->
            <div class="bg-zinc-900/50 backdrop-blur-sm border border-zinc-800/80 rounded-3xl p-8 hover:border-red-950/40 hover:shadow-red-950/5 transition-all duration-300 group tilt-3d">
                <div class="w-12 h-12 bg-red-950/30 rounded-2xl flex items-center justify-center text-red-400 border border-red-900/40 mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <h3 class="text-lg font-bold font-poppins text-zinc-200 mb-3">Three Lives in One Drop</h3>
                <p class="text-xs text-zinc-400 leading-relaxed">
                    Your single whole blood donation is separated into red blood cells, plasma, and platelets. You can rescue up to three individuals with one visit.
                </p>
            </div>

            <!-- Motivation Card 3 -->
            <div class="bg-zinc-900/50 backdrop-blur-sm border border-zinc-800/80 rounded-3xl p-8 hover:border-red-950/40 hover:shadow-red-950/5 transition-all duration-300 group tilt-3d">
                <div class="w-12 h-12 bg-red-950/30 rounded-2xl flex items-center justify-center text-red-400 border border-red-900/40 mb-6 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                </div>
                <h3 class="text-lg font-bold font-poppins text-zinc-200 mb-3">Critical Scarcity</h3>
                <p class="text-xs text-zinc-400 leading-relaxed">
                    Although 38% of the global population is eligible to donate blood, less than 3% actually do. Altruism is rare; your action represents hope.
                </p>
            </div>
        </div>

    </div>
</section>

<!-- COMPREHENSIVE BLOOD GROUP COMPATIBILITY GUIDE -->
<section class="py-20 bg-[#09090B]/40 border-t border-zinc-900/80 reveal-section">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="text-xs font-bold text-red-400 uppercase tracking-wider bg-red-950/40 border border-red-900/30 px-3 py-1 rounded-full">Compatibility Matrix</span>
            <h2 class="text-3xl font-extrabold font-poppins text-zinc-100 mt-3">Blood Group Compatibility Guide</h2>
            <p class="text-sm text-zinc-400 mt-3 leading-relaxed">
                Understanding which blood groups can exchange transfusions is medically critical. Explore the donor and recipient compatibility rules for all 8 blood types.
            </p>
        </div>

        <!-- 8 Blood Group Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            
            <!-- Card 1: O- (Universal Donor) -->
            <div class="bg-red-950/15 border border-red-500/40 rounded-3xl p-6 shadow-lg shadow-red-950/10 compat-card relative overflow-hidden highlight-o-minus animate-pulse-slow tilt-3d">
                <div class="absolute top-0 right-0 w-20 h-20 bg-red-950/40 rounded-bl-full flex items-start justify-end p-3 text-red-500 border-l border-b border-red-500/20">
                    <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-red-400 opacity-75 top-4 right-4"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 top-1 right-1"></span>
                </div>
                <div class="text-2xl font-extrabold text-red-400 font-poppins mb-2 flex items-center">
                    O- 
                    <span class="text-[9px] font-bold text-red-400 bg-red-950/60 border border-red-900/40 px-2 py-0.5 rounded-full ml-2">Universal</span>
                </div>
                <p class="text-[11px] text-zinc-400 mb-4">Can give to all, receives only from O-</p>
                <div class="space-y-2 text-xs border-t border-zinc-900/40 pt-3">
                    <p class="text-zinc-300"><span class="font-bold text-red-400">Gives To:</span> All Groups (Universal)</p>
                    <p class="text-zinc-300"><span class="font-bold text-zinc-100">Receives From:</span> O-</p>
                </div>
            </div>

            <!-- Card 2: O+ -->
            <div class="bg-zinc-900/60 backdrop-blur-md border border-zinc-800/80 rounded-3xl p-6 shadow-sm compat-card tilt-3d">
                <div class="text-2xl font-extrabold text-red-400 font-poppins mb-2">O+</div>
                <p class="text-[11px] text-zinc-400 mb-4">Highly common and vital donor type</p>
                <div class="space-y-2 text-xs border-t border-zinc-900/40 pt-3">
                    <p class="text-zinc-300"><span class="font-bold text-red-400">Gives To:</span> O+, A+, B+, AB+</p>
                    <p class="text-zinc-300"><span class="font-bold text-zinc-100">Receives From:</span> O+, O-</p>
                </div>
            </div>

            <!-- Card 3: A- -->
            <div class="bg-zinc-900/60 backdrop-blur-md border border-zinc-800/80 rounded-3xl p-6 shadow-sm compat-card tilt-3d">
                <div class="text-2xl font-extrabold text-red-400 font-poppins mb-2">A-</div>
                <p class="text-[11px] text-zinc-400 mb-4">Crucial support for A and AB types</p>
                <div class="space-y-2 text-xs border-t border-zinc-900/40 pt-3">
                    <p class="text-zinc-300"><span class="font-bold text-red-400">Gives To:</span> A+, A-, AB+, AB-</p>
                    <p class="text-zinc-300"><span class="font-bold text-zinc-100">Receives From:</span> A-, O-</p>
                </div>
            </div>

            <!-- Card 4: A+ -->
            <div class="bg-zinc-900/60 backdrop-blur-md border border-zinc-800/80 rounded-3xl p-6 shadow-sm compat-card tilt-3d">
                <div class="text-2xl font-extrabold text-red-400 font-poppins mb-2">A+</div>
                <p class="text-[11px] text-zinc-400 mb-4">Strong demand globally for clinics</p>
                <div class="space-y-2 text-xs border-t border-zinc-900/40 pt-3">
                    <p class="text-zinc-300"><span class="font-bold text-red-400">Gives To:</span> A+, AB+</p>
                    <p class="text-zinc-300"><span class="font-bold text-zinc-100">Receives From:</span> A+, A-, O+, O-</p>
                </div>
            </div>

            <!-- Card 5: B- -->
            <div class="bg-zinc-900/60 backdrop-blur-md border border-zinc-800/80 rounded-3xl p-6 shadow-sm compat-card tilt-3d">
                <div class="text-2xl font-extrabold text-red-400 font-poppins mb-2">B-</div>
                <p class="text-[11px] text-zinc-400 mb-4">Rare blood category in urgent need</p>
                <div class="space-y-2 text-xs border-t border-zinc-900/40 pt-3">
                    <p class="text-zinc-300"><span class="font-bold text-red-400">Gives To:</span> B+, B-, AB+, AB-</p>
                    <p class="text-zinc-300"><span class="font-bold text-zinc-100">Receives From:</span> B-, O-</p>
                </div>
            </div>

            <!-- Card 6: B+ -->
            <div class="bg-zinc-900/60 backdrop-blur-md border border-zinc-800/80 rounded-3xl p-6 shadow-sm compat-card tilt-3d">
                <div class="text-2xl font-extrabold text-red-400 font-poppins mb-2">B+</div>
                <p class="text-[11px] text-zinc-400 mb-4">Highly beneficial for B patients</p>
                <div class="space-y-2 text-xs border-t border-zinc-900/40 pt-3">
                    <p class="text-zinc-300"><span class="font-bold text-red-400">Gives To:</span> B+, AB+</p>
                    <p class="text-zinc-300"><span class="font-bold text-zinc-100">Receives From:</span> B+, B-, O+, O-</p>
                </div>
            </div>

            <!-- Card 7: AB- -->
            <div class="bg-zinc-900/60 backdrop-blur-md border border-zinc-800/80 rounded-3xl p-6 shadow-sm compat-card tilt-3d">
                <div class="text-2xl font-extrabold text-red-400 font-poppins mb-2">AB-</div>
                <p class="text-[11px] text-zinc-400 mb-4">The rarest blood type on earth</p>
                <div class="space-y-2 text-xs border-t border-zinc-900/40 pt-3">
                    <p class="text-zinc-300"><span class="font-bold text-red-400">Gives To:</span> AB+, AB-</p>
                    <p class="text-zinc-300"><span class="font-bold text-zinc-100">Receives From:</span> AB-, A-, B-, O-</p>
                </div>
            </div>

            <!-- Card 8: AB+ (Universal Recipient) -->
            <div class="bg-zinc-900/60 backdrop-blur-md border border-purple-500/40 rounded-3xl p-6 shadow-lg shadow-purple-950/10 compat-card relative overflow-hidden highlight-ab-plus tilt-3d">
                <div class="absolute top-0 right-0 w-20 h-20 bg-purple-950/40 rounded-bl-full flex items-start justify-end p-3 text-purple-400 border-l border-b border-purple-500/20">
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-purple-500"></span>
                </div>
                <div class="text-2xl font-extrabold text-purple-400 font-poppins mb-2 flex items-center">
                    AB+
                    <span class="text-[9px] font-bold text-purple-400 bg-purple-950/60 border border-purple-900/40 px-2 py-0.5 rounded-full ml-2">Recipient</span>
                </div>
                <p class="text-[11px] text-zinc-400 mb-4">Can give to AB+ only, receives from all</p>
                <div class="space-y-2 text-xs border-t border-zinc-900/40 pt-3">
                    <p class="text-zinc-300"><span class="font-bold text-red-400">Gives To:</span> AB+</p>
                    <p class="text-zinc-300"><span class="font-bold text-zinc-100">Receives From:</span> All Groups (Universal)</p>
                </div>
            </div>

        </div>

        <!-- Master Compatibility Table Graphic -->
        <div class="bg-zinc-900/40 backdrop-blur-sm border border-zinc-800/80 rounded-3xl p-6 md:p-8 shadow-lg overflow-x-auto">
            <h3 class="text-base font-bold font-poppins text-zinc-200 mb-4 flex items-center">
                <span class="w-1.5 h-3.5 bg-red-500 rounded-full mr-2"></span>
                Quick Reference Grid
            </h3>
            <table class="min-w-full divide-y divide-zinc-800/80 text-center text-xs">
                <thead>
                    <tr class="text-zinc-400 font-bold uppercase tracking-wider">
                        <th class="py-3 px-3 text-left">Recipient (row) \ Donor (col)</th>
                        <th class="py-3 px-2 bg-red-950/40 text-red-400 font-extrabold">O-</th>
                        <th class="py-3 px-2">O+</th>
                        <th class="py-3 px-2">A-</th>
                        <th class="py-3 px-2">A+</th>
                        <th class="py-3 px-2">B-</th>
                        <th class="py-3 px-2">B+</th>
                        <th class="py-3 px-2">AB-</th>
                        <th class="py-3 px-2">AB+</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-900/50 text-zinc-300">
                    <tr>
                        <td class="py-3 px-3 text-left font-bold text-zinc-200">O-</td>
                        <td class="py-3 px-2 bg-emerald-950/30 text-emerald-400 font-bold border border-emerald-950/20">✔</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-3 text-left font-bold text-zinc-200">O+</td>
                        <td class="py-3 px-2 bg-emerald-950/30 text-emerald-400 font-bold border border-emerald-950/20">✔</td>
                        <td class="py-3 px-2 bg-emerald-950/30 text-emerald-400 font-bold border border-emerald-950/20">✔</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-3 text-left font-bold text-zinc-200">A-</td>
                        <td class="py-3 px-2 bg-emerald-950/30 text-emerald-400 font-bold border border-emerald-950/20">✔</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 bg-emerald-950/30 text-emerald-400 font-bold border border-emerald-950/20">✔</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-3 text-left font-bold text-zinc-200">A+</td>
                        <td class="py-3 px-2 bg-emerald-950/30 text-emerald-400 font-bold border border-emerald-950/20">✔</td>
                        <td class="py-3 px-2 bg-emerald-950/30 text-emerald-400 font-bold border border-emerald-950/20">✔</td>
                        <td class="py-3 px-2 bg-emerald-950/30 text-emerald-400 font-bold border border-emerald-950/20">✔</td>
                        <td class="py-3 px-2 bg-emerald-950/30 text-emerald-400 font-bold border border-emerald-950/20">✔</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-3 text-left font-bold text-zinc-200">B-</td>
                        <td class="py-3 px-2 bg-emerald-950/30 text-emerald-400 font-bold border border-emerald-950/20">✔</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 bg-emerald-950/30 text-emerald-400 font-bold border border-emerald-950/20">✔</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-3 text-left font-bold text-zinc-200">B+</td>
                        <td class="py-3 px-2 bg-emerald-950/30 text-emerald-400 font-bold border border-emerald-950/20">✔</td>
                        <td class="py-3 px-2 bg-emerald-950/30 text-emerald-400 font-bold border border-emerald-950/20">✔</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 bg-emerald-950/30 text-emerald-400 font-bold border border-emerald-950/20">✔</td>
                        <td class="py-3 px-2 bg-emerald-950/30 text-emerald-400 font-bold border border-emerald-950/20">✔</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                    </tr>
                    <tr>
                        <td class="py-3 px-3 text-left font-bold text-zinc-200">AB-</td>
                        <td class="py-3 px-2 bg-emerald-950/30 text-emerald-400 font-bold border border-emerald-950/20">✔</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 bg-emerald-950/30 text-emerald-400 font-bold border border-emerald-950/20">✔</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 bg-emerald-950/30 text-emerald-400 font-bold border border-emerald-950/20">✔</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                        <td class="py-3 px-2 bg-emerald-950/30 text-emerald-400 font-bold border border-emerald-950/20">✔</td>
                        <td class="py-3 px-2 text-zinc-700">✖</td>
                    </tr>
                    <tr class="bg-purple-950/15 font-semibold">
                        <td class="py-3 px-3 text-left font-bold text-purple-300">AB+ (Universal)</td>
                        <td class="py-3 px-2 bg-purple-950/30 text-purple-400 font-bold border border-purple-950/20">✔</td>
                        <td class="py-3 px-2 bg-purple-950/30 text-purple-400 font-bold border border-purple-950/20">✔</td>
                        <td class="py-3 px-2 bg-purple-950/30 text-purple-400 font-bold border border-purple-950/20">✔</td>
                        <td class="py-3 px-2 bg-purple-950/30 text-purple-400 font-bold border border-purple-950/20">✔</td>
                        <td class="py-3 px-2 bg-purple-950/30 text-purple-400 font-bold border border-purple-950/20">✔</td>
                        <td class="py-3 px-2 bg-purple-950/30 text-purple-400 font-bold border border-purple-950/20">✔</td>
                        <td class="py-3 px-2 bg-purple-950/30 text-purple-400 font-bold border border-purple-950/20">✔</td>
                        <td class="py-3 px-2 bg-purple-950/30 text-purple-400 font-bold border border-purple-950/20">✔</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</section>

<!-- BENEFITS & ELIGIBILITY CHECKLIST -->
<section class="py-20 bg-transparent border-t border-zinc-900/80 reveal-section">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <!-- LHS: Comprehensive Benefits Column -->
            <div class="space-y-8">
                <div>
                    <span class="text-xs font-bold text-red-400 uppercase tracking-wider bg-red-950/40 border border-red-900/30 px-3 py-1 rounded-full">Health & Welfare</span>
                    <h2 class="text-3xl font-extrabold font-poppins text-zinc-100 mt-3">Benefits of Donating Blood</h2>
                    <p class="text-sm text-zinc-400 mt-2">
                        While saving lives is the ultimate gift, donating blood also triggers positive physiological and cognitive health indicators for the donor.
                    </p>
                </div>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-red-950/30 rounded-xl flex items-center justify-center text-red-400 border border-red-900/30 mr-4 flex-shrink-0 font-bold">
                            1
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-zinc-200">Stimulates Fresh Blood Generation</h4>
                            <p class="text-xs text-zinc-400 mt-1 leading-relaxed">Donating whole blood prompts the bone marrow to produce new red cells, keeping your vascular system performing optimally.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-red-950/30 rounded-xl flex items-center justify-center text-red-400 border border-red-900/30 mr-4 flex-shrink-0 font-bold">
                            2
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-zinc-200">Complimentary Health Screening</h4>
                            <p class="text-xs text-zinc-400 mt-1 leading-relaxed">You receive a vital signs screening (blood pressure, temperature, hemoglobin levels, pulse) offering a regular medical checkpoint.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-red-950/30 rounded-xl flex items-center justify-center text-red-400 border border-red-900/30 mr-4 flex-shrink-0 font-bold">
                            3
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-zinc-200">Lower Risk of Iron Overload</h4>
                            <p class="text-xs text-zinc-400 mt-1 leading-relaxed">Donations lower excessive iron concentrations in the circulatory system, protecting tissue and arteries from oxidation.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-red-950/30 rounded-xl flex items-center justify-center text-red-400 border border-red-900/30 mr-4 flex-shrink-0 font-bold">
                            4
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-zinc-200">Calorie Balancing & Mind Wellness</h4>
                            <p class="text-xs text-zinc-400 mt-1 leading-relaxed">Donating one pint of blood burns roughly 650 calories. It triggers significant cognitive satisfaction and lowers cortisol levels.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RHS: Eligibility Checklist -->
            <div class="bg-zinc-900/60 backdrop-blur-md border border-zinc-800/80 rounded-3xl p-8 lg:p-10 shadow-2xl tilt-3d">
                <h3 class="text-lg font-bold font-poppins text-zinc-200 mb-6 flex items-center">
                    <svg class="w-5 h-5 text-emerald-400 mr-2" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Eligibility Checklist
                </h3>
                
                <ul class="space-y-5">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-emerald-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <div>
                            <span class="text-sm font-semibold text-zinc-200">Age Requirements</span>
                            <p class="text-xs text-zinc-400 mt-0.5">Must be at least 18 years old and under 65 years old.</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-emerald-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <div>
                            <span class="text-sm font-semibold text-zinc-200">Minimum Weight</span>
                            <p class="text-xs text-zinc-400 mt-0.5">Must weigh at least 50 kg (110 lbs) to ensure safe blood volume draw.</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-emerald-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <div>
                            <span class="text-sm font-semibold text-zinc-200">General Health</span>
                            <p class="text-xs text-zinc-400 mt-0.5">Must be in good health at the time of donation, without symptoms of cold, flu, or active infection.</p>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-emerald-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <div>
                            <span class="text-sm font-semibold text-zinc-200">Donation Interval Cooldown</span>
                            <p class="text-xs text-zinc-400 mt-0.5">Must not have donated whole blood in the last 90 days (cooldown interval).</p>
                        </div>
                    </li>
                </ul>
                
                <div class="mt-8 pt-6 border-t border-zinc-800/80 flex justify-center">
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 text-xs font-semibold text-white rounded-xl shadow-lg border border-red-500/20 transition-all">
                        Check My Eligibility Dashboard
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Lightweight Native Scroll Entry Animation script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sections = document.querySelectorAll('.reveal-section');
        
        const observerOptions = {
            root: null,
            threshold: 0.1,
            rootMargin: "0px 0px -50px 0px"
        };
        
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target); // Stop observing once triggered
                }
            });
        }, observerOptions);
        
        sections.forEach(section => {
            observer.observe(section);
        });
    });
</script>
@endsection
