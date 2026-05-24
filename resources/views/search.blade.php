@extends('layouts.app')

@section('title', 'Emergency Blood Search Results - Lifedrop')

@section('content')
<section class="py-12 bg-gradient-to-b from-[#020203] via-[#09090B] to-[#020203] min-h-screen relative z-10">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        
        <!-- Filter Header Info -->
        <div class="mb-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-bold text-red-500 uppercase tracking-wider">Emergency Search Space</span>
                <h1 class="text-3xl font-extrabold font-poppins text-zinc-100 mt-1">Matched Blood Donors</h1>
                <p class="text-sm text-zinc-400 mt-2">
                    Showing results for: 
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-950/30 text-red-400 border border-red-900/40 uppercase">
                        Blood Group: {{ $bloodGroup ?: 'Any' }}
                    </span>
                    @if($city)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-zinc-900 text-zinc-300 border border-zinc-800">
                            City: {{ $city }}
                        </span>
                    @endif
                </p>
            </div>
            
            <a href="{{ route('home') }}#search-fold" class="px-4 py-2 text-xs font-semibold text-zinc-300 bg-zinc-950/60 border border-zinc-900 rounded-xl hover:bg-zinc-900 hover:text-white transition-all flex items-center gap-1.5 shadow-lg shadow-black/40">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                New Search
            </a>
        </div>

        <!-- Grid Layout -->
        @if($donors->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($donors as $donor)
                    <!-- Donor Card -->
                    <div class="bg-zinc-900/40 backdrop-blur-md border border-zinc-800/80 rounded-3xl p-6 shadow-xl hover:border-red-900/40 hover:shadow-red-950/5 transition-all duration-300 flex flex-col justify-between tilt-3d">
                        <div>
                            <!-- Top header -->
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <!-- Profile Picture / Avatar -->
                                    @if($donor->avatar)
                                        <img class="w-12 h-12 rounded-2xl border border-zinc-850 object-cover" src="{{ asset($donor->avatar) }}" alt="{{ $donor->name }}">
                                    @else
                                        <div class="w-12 h-12 rounded-2xl bg-red-950/40 flex items-center justify-center font-bold text-red-500 border border-red-900/40 text-lg">
                                            {{ strtoupper(substr(auth()->user() ? auth()->user()->name : $donor->name, 0, 2)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <h3 class="text-sm font-bold text-zinc-100">{{ $donor->name }}</h3>
                                        <p class="text-xs text-zinc-400 flex items-center mt-0.5">
                                            <svg class="w-3.5 h-3.5 text-zinc-500 mr-1 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            {{ $donor->city }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Blood Group Badge -->
                                <div class="w-10 h-10 bg-red-950/30 text-red-500 border border-red-900/40 rounded-xl flex items-center justify-center font-bold text-sm shadow-md">
                                    {{ $donor->blood_group }}
                                </div>
                            </div>

                            <!-- Availability status -->
                            <div class="mb-6 flex items-center justify-between">
                                <span class="text-xs text-zinc-400 font-medium">Status</span>
                                
                                @php
                                    $cooldown = $donor->cooldownDays();
                                    $available = $donor->is_available && $cooldown === 0;
                                @endphp

                                @if($available)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-950/30 text-emerald-400 border border-emerald-900/40">
                                        <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full glowing-dot-active mr-1.5"></span>
                                        ● Available Now
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-zinc-950/60 text-zinc-400 border border-zinc-900">
                                        <span class="w-2 h-2 bg-zinc-600 rounded-full mr-1.5"></span>
                                        ○ Busy / Cooldown
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Action Button & Masked Data -->
                        <div class="border-t border-zinc-900 pt-4 mt-2">
                            @auth
                                <div class="space-y-3">
                                    <p class="text-xs text-zinc-400 flex items-center justify-center py-1">
                                        <svg class="w-4 h-4 text-emerald-500 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                        <span class="font-semibold text-zinc-200 text-sm tracking-wide">{{ $donor->phone }}</span>
                                    </p>
                                    <a href="tel:{{ $donor->phone }}" class="block w-full py-2.5 text-center text-xs font-bold text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 rounded-xl transition-all shadow-md shadow-red-950/20">
                                        Dial Donor Now
                                    </a>
                                </div>
                            @else
                                <div class="space-y-3">
                                    <div class="bg-zinc-950/40 border border-dashed border-zinc-800/80 rounded-xl p-3 text-center">
                                        <p class="text-[11px] text-zinc-400 flex items-center justify-center mb-1">
                                            <svg class="w-3.5 h-3.5 text-red-500 mr-1.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                            Phone Masked for Security
                                        </p>
                                        <span class="font-mono text-xs font-bold text-zinc-400 tracking-widest">+1 (•••) •••-••••</span>
                                    </div>
                                    <a href="{{ route('login') }}?redirect_to={{ urlencode(request()->fullUrl()) }}" class="block w-full py-2.5 text-center text-xs font-bold text-zinc-300 bg-zinc-900/60 hover:bg-zinc-800/60 border border-zinc-800 rounded-xl transition-all">
                                        Login to Contact
                                    </a>
                                </div>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty Results State -->
            <div class="bg-zinc-900/40 backdrop-blur-md border border-zinc-800/80 rounded-3xl p-12 text-center max-w-xl mx-auto shadow-2xl tilt-3d">
                <div class="w-16 h-16 bg-red-950/40 rounded-full flex items-center justify-center text-red-500 mx-auto mb-6 border border-red-900/35">
                    <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-bold font-poppins text-zinc-100 mb-2">No Matching Donors Available</h2>
                <p class="text-sm text-zinc-400 mb-8 leading-relaxed">
                    We currently do not have registered, available donors matching blood type <span class="font-bold text-red-500">{{ $bloodGroup ?: 'Any' }}</span> in <span class="font-bold text-zinc-300">{{ $city ?: 'any city' }}</span>.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('requests.create') }}" class="w-full sm:w-auto px-6 py-3 text-xs font-bold text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 rounded-xl shadow-lg shadow-red-950/40 transition-all">
                        Create Crisis Request
                    </a>
                    <a href="{{ route('home') }}#search-fold" class="w-full sm:w-auto px-6 py-3 text-xs font-bold text-zinc-300 bg-zinc-950/60 hover:bg-zinc-900 border border-zinc-800 rounded-xl transition-all">
                        Modify Filters
                    </a>
                </div>
            </div>
        @endif
        
    </div>
</section>
@endsection
