@extends('layouts.app')

@section('title', 'Register as a Blood Donor - Lifedrop')

@section('content')
<section class="py-12 bg-gradient-to-b from-[#020203] via-[#09090B] to-[#020203] min-h-screen flex items-center relative z-10">
    <div class="px-4 mx-auto max-w-2xl w-full">
        <div class="bg-zinc-900/40 backdrop-blur-md border border-zinc-800/80 rounded-3xl p-8 shadow-2xl">
            <!-- Header branding -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-12 h-12 bg-red-950/40 text-red-500 border border-red-900/40 rounded-2xl mb-4 shadow-lg shadow-red-950/20">
                    <svg class="w-6 h-6 fill-current animate-pulse" viewBox="0 0 24 24">
                        <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold font-poppins text-zinc-100">Become a Life-Saver</h1>
                <p class="text-xs text-zinc-400 mt-1.5 leading-relaxed">Register as a blood donor today and help families in crisis</p>
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
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-xs font-semibold text-zinc-450 uppercase mb-2">Full Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="e.g. Jane Smith" class="block w-full px-4 py-3 bg-zinc-950 border border-zinc-800 rounded-xl text-sm text-zinc-200 placeholder-zinc-650 focus:border-red-500 focus:ring-1 focus:ring-red-500/25">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xs font-semibold text-zinc-450 uppercase mb-2">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="jane@example.com" class="block w-full px-4 py-3 bg-zinc-950 border border-zinc-800 rounded-xl text-sm text-zinc-200 placeholder-zinc-650 focus:border-red-500 focus:ring-1 focus:ring-red-500/25">
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone" class="block text-xs font-semibold text-zinc-450 uppercase mb-2">Phone Number</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required placeholder="e.g. +1 (555) 000-0000" class="block w-full px-4 py-3 bg-zinc-950 border border-zinc-800 rounded-xl text-sm text-zinc-200 placeholder-zinc-650 focus:border-red-500 focus:ring-1 focus:ring-red-500/25">
                        <p class="text-[10px] text-zinc-500 mt-1.5">Masked for guest protection.</p>
                    </div>

                    <!-- Precise Date of Birth -->
                    <div>
                        <label for="dob" class="block text-xs font-semibold text-zinc-450 uppercase mb-2">Date of Birth</label>
                        <input type="date" name="dob" id="dob" value="{{ old('dob') }}" required class="block w-full px-4 py-3 bg-zinc-950 border border-zinc-800 rounded-xl text-sm text-zinc-200 focus:border-red-500 focus:ring-1 focus:ring-red-500/25">
                        <p class="text-[10px] text-red-400 mt-1.5">Must be at least 18 years old to donate.</p>
                    </div>

                    <!-- Gender -->
                    <div>
                        <label for="gender" class="block text-xs font-semibold text-zinc-450 uppercase mb-2">Gender</label>
                        <select name="gender" id="gender" required class="block w-full px-4 py-3 bg-zinc-950 border border-zinc-800 rounded-xl text-sm text-zinc-200 cursor-pointer">
                            <option value="" class="bg-zinc-950">Select Gender</option>
                            <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }} class="bg-zinc-950">Male</option>
                            <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }} class="bg-zinc-950">Female</option>
                            <option value="Other" {{ old('gender') === 'Other' ? 'selected' : '' }} class="bg-zinc-950">Other</option>
                        </select>
                    </div>

                    <!-- Blood Group -->
                    <div>
                        <label for="blood_group" class="block text-xs font-semibold text-zinc-450 uppercase mb-2">Blood Group</label>
                        <select name="blood_group" id="blood_group" required class="block w-full px-4 py-3 bg-zinc-950 border border-zinc-800 rounded-xl text-sm text-zinc-200 cursor-pointer">
                            <option value="" class="bg-zinc-950">Select Blood Group</option>
                            <option value="A+" {{ old('blood_group') === 'A+' ? 'selected' : '' }} class="bg-zinc-950">A+</option>
                            <option value="A-" {{ old('blood_group') === 'A-' ? 'selected' : '' }} class="bg-zinc-950">A-</option>
                            <option value="B+" {{ old('blood_group') === 'B+' ? 'selected' : '' }} class="bg-zinc-950">B+</option>
                            <option value="B-" {{ old('blood_group') === 'B-' ? 'selected' : '' }} class="bg-zinc-950">B-</option>
                            <option value="AB+" {{ old('blood_group') === 'AB+' ? 'selected' : '' }} class="bg-zinc-950">AB+</option>
                            <option value="AB-" {{ old('blood_group') === 'AB-' ? 'selected' : '' }} class="bg-zinc-950">AB-</option>
                            <option value="O+" {{ old('blood_group') === 'O+' ? 'selected' : '' }} class="bg-zinc-950">O+</option>
                            <option value="O-" {{ old('blood_group') === 'O-' ? 'selected' : '' }} class="bg-zinc-950">O-</option>
                        </select>
                    </div>

                    <!-- City -->
                    <div>
                        <label for="city" class="block text-xs font-semibold text-zinc-450 uppercase mb-2">City</label>
                        <input type="text" name="city" id="city" value="{{ old('city') }}" required placeholder="e.g. New York" class="block w-full px-4 py-3 bg-zinc-950 border border-zinc-800 rounded-xl text-sm text-zinc-200 placeholder-zinc-650 focus:border-red-500 focus:ring-1 focus:ring-red-500/25">
                    </div>

                    <!-- Profile Image Upload Field -->
                    <div>
                        <label for="avatar" class="block text-xs font-semibold text-zinc-450 uppercase mb-2">Profile Image (Avatar)</label>
                        <input type="file" name="avatar" id="avatar" accept="image/*" class="block w-full text-xs border border-zinc-800 bg-zinc-950 rounded-xl cursor-pointer text-zinc-400 file:bg-zinc-900 file:text-zinc-250 file:border-0 file:py-3 file:px-4 file:mr-3 file:text-xs">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-zinc-800/80">
                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-xs font-semibold text-zinc-450 uppercase mb-2">Password</label>
                        <input type="password" name="password" id="password" required placeholder="••••••••" class="block w-full px-4 py-3 bg-zinc-950 border border-zinc-800 rounded-xl text-sm text-zinc-200 placeholder-zinc-650 focus:border-red-500 focus:ring-1 focus:ring-red-500/25">
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-xs font-semibold text-zinc-450 uppercase mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="••••••••" class="block w-full px-4 py-3 bg-zinc-950 border border-zinc-800 rounded-xl text-sm text-zinc-200 placeholder-zinc-650 focus:border-red-500 focus:ring-1 focus:ring-red-500/25">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="w-full py-4 px-4 text-sm font-bold text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 rounded-xl shadow-lg shadow-red-950/40 transition-all border border-red-500/20">
                        Register & Save Lives
                    </button>
                </div>
            </form>

            <div class="border-t border-zinc-800/80 mt-8 pt-6 text-center text-xs text-zinc-400">
                Already registered with Lifedrop? 
                <a href="{{ route('login') }}" class="font-bold text-red-500 hover:underline ml-1">Log In Here</a>
            </div>
        </div>
    </div>
</section>
@endsection
