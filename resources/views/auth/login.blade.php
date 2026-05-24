@extends('layouts.app')

@section('title', 'Secure Login - Lifedrop')

@section('content')
<section class="py-16 bg-gradient-to-b from-[#020203] via-[#09090B] to-[#020203] min-h-[80vh] flex items-center relative z-10">
    <div class="px-4 mx-auto max-w-md w-full">
        <div class="bg-zinc-900/40 backdrop-blur-md border border-zinc-800/80 rounded-3xl p-8 shadow-2xl">
            <!-- Header branding -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-red-950/40 text-red-500 border border-red-900/40 rounded-2xl mb-4 shadow-lg shadow-red-950/20">
                    <svg class="w-6 h-6 fill-current animate-pulse" viewBox="0 0 24 24">
                        <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold font-poppins text-zinc-100">Welcome Back</h1>
                <p class="text-xs text-zinc-400 mt-1.5 leading-relaxed">Sign in to manage your donor profile or post crises</p>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-950/30 border border-red-900/40 rounded-2xl text-xs text-red-400 font-semibold space-y-1 shadow-inner">
                    @foreach ($errors->all() as $error)
                        <p class="flex items-center">
                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-2"></span>
                            {{ $error }}
                        </p>
                    @endforeach
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                
                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-zinc-400 uppercase mb-2">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus placeholder="name@domain.com" class="block w-full px-4 py-3 bg-zinc-950 border border-zinc-800 rounded-xl text-sm text-zinc-200 placeholder-zinc-650 focus:border-red-500 focus:ring-1 focus:ring-red-500/25">
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-xs font-semibold text-zinc-400 uppercase">Password</label>
                    </div>
                    <input type="password" name="password" id="password" required placeholder="••••••••" class="block w-full px-4 py-3 bg-zinc-950 border border-zinc-800 rounded-xl text-sm text-zinc-200 placeholder-zinc-650 focus:border-red-500 focus:ring-1 focus:ring-red-500/25">
                </div>

                <!-- Remember me -->
                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center text-zinc-400 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-red-650 bg-zinc-950 border-zinc-800 rounded focus:ring-red-500/25 mr-2 cursor-pointer">
                        Remember session
                    </label>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full py-3.5 px-4 text-sm font-bold text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 rounded-xl shadow-lg shadow-red-950/40 transition-all border border-red-500/20">
                        Sign In Securely
                    </button>
                </div>
            </form>

            <div class="border-t border-zinc-800/80 mt-8 pt-6 text-center text-xs text-zinc-400">
                New to Lifedrop? 
                <a href="{{ route('register') }}" class="font-bold text-red-500 hover:underline ml-1">Register as Donor</a>
            </div>
        </div>
    </div>
</section>
@endsection
