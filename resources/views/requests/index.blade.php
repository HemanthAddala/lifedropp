@extends('layouts.app')

@section('title', 'Emergency Public Requests Feed - Lifedrop')

@section('content')
<section class="py-12 bg-gradient-to-b from-[#020203] via-[#09090B] to-[#020203] min-h-screen relative z-10">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-bold text-red-500 uppercase tracking-wider">Emergency Portal</span>
                <h1 class="text-3xl font-extrabold font-poppins text-zinc-100 mt-1">Live Crisis Board</h1>
                <p class="text-sm text-zinc-400 mt-2">Active emergency calls for blood donations from local families and partner hospitals.</p>
            </div>
            
            <a href="{{ route('requests.create') }}" class="px-5 py-3 text-sm font-semibold text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 rounded-xl shadow-lg shadow-red-950/40 transition-all flex items-center gap-2 border border-red-500/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Post an Emergency Crisis
            </a>
        </div>

        <!-- Feed List -->
        @if($requests->count() > 0)
            <div class="space-y-6 max-w-4xl mx-auto">
                @foreach($requests as $req)
                    <!-- Request Card -->
                    <div class="bg-zinc-900/40 backdrop-blur-md border border-zinc-800/80 rounded-3xl p-6 md:p-8 shadow-xl hover:border-red-900/40 hover:shadow-red-950/5 transition-all duration-300 relative flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                        
                        <!-- Urgency Label -->
                        @if($req->urgency === 'urgent')
                            <span class="absolute top-4 right-4 px-2.5 py-0.5 text-[9px] font-bold text-white bg-red-600 rounded-full uppercase tracking-wider animate-pulse glowing-dot-active">
                                CRITICAL URGENCY
                            </span>
                        @endif

                        <!-- LHS: Blood Group and Patient Details -->
                        <div class="flex items-start sm:items-center space-x-5 flex-grow">
                            <!-- Large Red Blood Box -->
                            <div class="w-20 h-20 bg-red-950/30 text-red-500 border-2 border-red-900/40 rounded-2xl flex flex-col items-center justify-center flex-shrink-0 shadow-lg shadow-red-950/20">
                                <span class="text-3xl font-extrabold font-poppins leading-none">{{ $req->blood_group }}</span>
                                <span class="text-[9px] font-semibold text-red-400/80 uppercase tracking-widest mt-1">Group</span>
                            </div>
                            
                            <!-- Patient metadata -->
                            <div>
                                <div class="flex flex-wrap items-center gap-2">
                                    <h3 class="text-base font-bold text-zinc-100">Patient: {{ $req->patient_name }}</h3>
                                    <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-red-950/40 border border-red-900/40 text-red-400 uppercase">
                                        {{ $req->units }} Unit{{ $req->units > 1 ? 's' : '' }} Needed
                                    </span>
                                </div>
                                
                                <div class="space-y-1.5 text-xs text-zinc-400 mt-3 font-medium">
                                    <p class="flex items-center">
                                        <svg class="w-4 h-4 text-zinc-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                        Hospital: <span class="font-bold text-zinc-300 ml-1 truncate max-w-[200px] sm:max-w-xs">{{ $req->hospital_name }}</span>
                                    </p>
                                    <p class="flex items-start">
                                        <svg class="w-4 h-4 text-zinc-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        Location: <span class="text-zinc-400 ml-1">{{ $req->hospital_address }}, {{ $req->city }}</span>
                                    </p>
                                    <p class="flex items-center">
                                        <svg class="w-4 h-4 text-zinc-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        Contact: <span class="text-zinc-300 ml-1 font-semibold">{{ $req->contact_person }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- RHS: Seeker phone & CTA Button -->
                        <div class="border-t md:border-t-0 md:border-l border-zinc-800/80 pt-4 md:pt-0 md:pl-6 w-full md:w-auto flex-shrink-0 flex flex-col justify-center gap-3">
                            @auth
                                <p class="text-xs text-zinc-400 flex items-center justify-center py-1">
                                    <svg class="w-4 h-4 text-emerald-500 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    <span class="font-bold text-zinc-200 text-sm tracking-wide">{{ $req->contact_phone }}</span>
                                </p>
                                <form method="POST" action="{{ route('requests.donate', $req->id) }}">
                                    @csrf
                                    <button type="submit" class="w-full md:w-auto px-5 py-3 text-xs font-bold text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 rounded-xl transition-all shadow-md flex items-center justify-center gap-1.5 border border-red-500/20">
                                        <svg class="w-4 h-4 text-white fill-current" viewBox="0 0 24 24">
                                            <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z" />
                                        </svg>
                                        I Can Donate Now
                                    </button>
                                </form>
                            @else
                                <div class="bg-zinc-950/40 border border-zinc-800/80 rounded-xl px-3 py-2 text-center">
                                    <span class="block text-[10px] text-zinc-500 mb-0.5 font-medium">Phone Masked (Guest)</span>
                                    <span class="font-mono text-xs font-bold text-zinc-400 tracking-wider">+1 (•••) •••-••••</span>
                                </div>
                                <a href="{{ route('login') }}?redirect_to={{ urlencode(request()->fullUrl()) }}" class="w-full text-center px-4 py-2.5 text-xs font-bold text-zinc-300 bg-zinc-900/60 hover:bg-zinc-850 border border-zinc-800 rounded-xl transition-all">
                                    Login to Connect
                                </a>
                            @endauth
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty feed state -->
            <div class="bg-zinc-900/40 backdrop-blur-md border border-zinc-800/80 rounded-3xl p-12 text-center max-w-xl mx-auto shadow-2xl">
                <div class="w-16 h-16 bg-red-950/40 rounded-full flex items-center justify-center text-red-500 mx-auto mb-6 border border-red-900/35">
                    <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-bold font-poppins text-zinc-100 mb-2">No Active Crises Reported</h2>
                <p class="text-sm text-zinc-400 mb-6 leading-relaxed">
                    There are currently no active, approved emergency blood requests posted on the network.
                </p>
                <a href="{{ route('requests.create') }}" class="inline-flex items-center px-6 py-3 text-xs font-bold text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 rounded-xl shadow-lg shadow-red-950/40 transition-all border border-red-500/20">
                    Post Crisis Request
                </a>
            </div>
        @endif

    </div>
</section>
@endsection
