@extends('layouts.app')

@section('title', 'My Profile Control Panel - Lifedrop')

@section('content')
<section class="py-12 bg-gradient-to-b from-[#020203] via-[#09090B] to-[#020203] min-h-screen relative z-10">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        
        <!-- Welcome banner -->
        <div class="mb-10 flex flex-col md:flex-row items-start md:items-center justify-between bg-zinc-900/40 backdrop-blur-md border border-zinc-800/80 p-6 md:p-8 rounded-3xl shadow-xl gap-4 tilt-3d">
            <div class="flex items-center space-x-4">
                <!-- Avatar -->
                @if($user->avatar)
                    <img class="w-16 h-16 rounded-2xl border border-zinc-800 object-cover" src="{{ asset($user->avatar) }}" alt="{{ $user->name }}">
                @else
                    <div class="w-16 h-16 rounded-2xl bg-red-950/40 flex items-center justify-center font-bold text-red-500 border border-red-900/40 text-2xl">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                @endif
                <div>
                    <h1 class="text-xl font-bold font-poppins text-zinc-100">Welcome, {{ $user->name }}!</h1>
                    <p class="text-xs text-zinc-400 mt-1">Donor Group: <span class="font-bold text-red-500">{{ $user->blood_group }}</span> | City: <span class="font-semibold text-zinc-300">{{ $user->city }}</span></p>
                </div>
            </div>

            <!-- Gamified Tier Badge Card -->
            <div class="mt-4 md:mt-0 flex items-center bg-red-950/20 border border-red-900/30 px-4 py-3 rounded-2xl">
                <!-- Badge Medal Graphic -->
                <div class="w-10 h-10 bg-red-950/50 rounded-xl flex items-center justify-center text-red-500 border border-red-900/40 mr-3">
                    @if($badgeTier === 'First Drop')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.364l-.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z"/></svg>
                    @elseif($badgeTier === 'Life Saver')
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/></svg>
                    @else
                        <svg class="w-6 h-6 text-yellow-500 fill-current animate-pulse" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    @endif
                </div>
                <div>
                    <span class="block text-[10px] font-bold text-red-400 uppercase tracking-wider">Contribution Tier</span>
                    <span class="text-xs font-bold text-zinc-200 font-poppins">{{ $badgeTier }} Badge</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- LHS: Profile toggles & details update -->
            <div class="space-y-8 lg:col-span-2">
                
                <!-- Availability & Cooldown Switch Card -->
                <div class="bg-zinc-900/40 backdrop-blur-md border border-zinc-800/80 rounded-3xl p-6 md:p-8 shadow-xl tilt-3d">
                    <h2 class="text-lg font-bold font-poppins text-zinc-100 mb-6 flex items-center">
                        <span class="w-2 h-4 bg-red-600 rounded-full mr-2"></span>
                        Emergency Availability Switch
                    </h2>

                    <!-- Switch toggle form -->
                    <form method="POST" action="{{ route('dashboard.availability') }}" class="mb-6">
                        @csrf
                        <button type="submit" class="w-full text-left focus:outline-none transition-all duration-300">
                            @if($user->is_available && $cooldownDays === 0)
                                <div class="bg-emerald-950/20 border border-emerald-900/40 rounded-2xl p-6 flex items-center justify-between hover:bg-emerald-950/30 transition-colors">
                                    <div>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-950/60 text-emerald-400 border border-emerald-900/40 uppercase mb-2">
                                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full glowing-dot-active mr-1"></span>
                                            Active
                                        </span>
                                        <h3 class="text-sm font-bold text-emerald-300">[ON] Ready to receive emergency requests</h3>
                                        <p class="text-xs text-emerald-400/70 mt-1">You are visible in search results and can receive emergency calls.</p>
                                    </div>
                                    <!-- Slide toggle mimic -->
                                    <div class="w-14 h-8 bg-emerald-600 rounded-full p-1 transition-colors duration-300 flex items-center justify-end">
                                        <div class="w-6 h-6 bg-zinc-100 rounded-full shadow-md"></div>
                                    </div>
                                </div>
                            @else
                                <div class="bg-zinc-950/40 border border-zinc-850 rounded-2xl p-6 flex items-center justify-between hover:bg-zinc-950/60 transition-colors">
                                    <div>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-zinc-900 text-zinc-400 border border-zinc-800 uppercase mb-2">
                                            Paused
                                        </span>
                                        <h3 class="text-sm font-bold text-zinc-300">[OFF] Temporarily unavailable</h3>
                                        @if($cooldownDays > 0)
                                            <p class="text-xs text-red-400 mt-1 font-semibold">Active medical rest (90-day cooldown countdown in effect).</p>
                                        @else
                                            <p class="text-xs text-zinc-500 mt-1">Currently offline or resting. Searchers cannot locate you.</p>
                                        @endif
                                    </div>
                                    <!-- Slide toggle mimic -->
                                    <div class="w-14 h-8 bg-zinc-800 rounded-full p-1 transition-colors duration-300 flex items-center justify-start">
                                        <div class="w-6 h-6 bg-zinc-650 rounded-full shadow-md"></div>
                                    </div>
                                </div>
                            @endif
                        </button>
                    </form>

                    <!-- Cooldown Panel details -->
                    <div class="border-t border-zinc-800/80 pt-6">
                        @if($cooldownDays > 0)
                            <div class="bg-red-950/20 border border-red-900/40 rounded-2xl p-4 flex items-start">
                                <div class="w-8 h-8 bg-red-950/50 rounded-xl flex items-center justify-center text-red-500 mr-3 mt-0.5 border border-red-900/40">
                                    <svg class="w-4 h-4 fill-current animate-pulse" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-red-400 uppercase tracking-wider">Medical Cooldown countdown</h4>
                                    <p class="text-sm font-bold text-zinc-200 mt-1">Cooldown Active: {{ $cooldownDays }} Days Remaining</p>
                                    <p class="text-xs text-zinc-400 mt-1 leading-relaxed">
                                        By medical rules, donors must rest for 90 days between donations. You will automatically become available once the cooldown ends.
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="bg-emerald-950/20 border border-emerald-900/30 rounded-2xl p-4 flex items-start">
                                <div class="w-8 h-8 bg-emerald-950/50 rounded-xl flex items-center justify-center text-emerald-400 mr-3 mt-0.5 border border-emerald-900/40">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-emerald-400 uppercase tracking-wider">Eligible to Donate</h4>
                                    <p class="text-sm font-bold text-emerald-300 mt-1">You are fully eligible to donate blood today!</p>
                                    <p class="text-xs text-zinc-400 mt-1 leading-relaxed">
                                        No active cooldowns detected. Keep your availability switch ON to receive live matches from families in crisis.
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Donation Logs Card -->
                <div class="bg-zinc-900/40 backdrop-blur-md border border-zinc-800/80 rounded-3xl p-6 md:p-8 shadow-xl tilt-3d">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-2">
                        <h2 class="text-lg font-bold font-poppins text-zinc-100 flex items-center">
                            <span class="w-2 h-4 bg-red-600 rounded-full mr-2"></span>
                            My Donation Logs
                        </h2>
                        <span class="text-xs font-semibold text-zinc-450 mt-1 sm:mt-0">Total: {{ $logs->count() }} donation{{ $logs->count() !== 1 ? 's' : '' }}</span>
                    </div>

                    <!-- Add log form errors -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-950/30 border border-red-900/40 text-red-400 text-xs rounded-2xl shadow-sm">
                            <h4 class="font-bold text-red-400 uppercase tracking-wider mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-1 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                Logging Attempt Failed
                            </h4>
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('dashboard.logs') }}" class="grid grid-cols-1 sm:grid-cols-4 gap-4 items-end mb-8 p-4 bg-zinc-950/50 border border-zinc-850 rounded-2xl">
                        @csrf
                        <div>
                            <label for="donation_date" class="block text-[10px] font-bold text-zinc-450 uppercase tracking-wider mb-2">Donation Date</label>
                            <input type="date" name="donation_date" id="donation_date" required max="{{ date('Y-m-d', strtotime('+1 day')) }}" class="block w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-xl text-xs text-zinc-200">
                        </div>
                        <div>
                            <label for="location" class="block text-[10px] font-bold text-zinc-450 uppercase tracking-wider mb-2">Hospital/Camp Location</label>
                            <input type="text" name="location" id="location" required placeholder="e.g. Red Cross, New York" class="block w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-xl text-xs text-zinc-200 placeholder-zinc-650">
                        </div>
                        <div>
                            <label for="units" class="block text-[10px] font-bold text-zinc-450 uppercase tracking-wider mb-2">Units Donated</label>
                            <select name="units" id="units" class="block w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-xl text-xs text-zinc-200 cursor-pointer">
                                <option value="1" selected class="bg-zinc-950">1 Unit (Standard)</option>
                                <option value="2" class="bg-zinc-950">2 Units</option>
                                <option value="3" class="bg-zinc-950">3 Units</option>
                                <option value="4" class="bg-zinc-950">4 Units</option>
                                <option value="5" class="bg-zinc-950">5 Units</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="w-full py-2 px-4 text-xs font-bold text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 rounded-xl shadow-md transition-all border border-red-500/20">
                                Log Donation
                            </button>
                        </div>
                    </form>

                    <!-- Logs Table -->
                    @if($logs->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-zinc-800/80 text-xs">
                                <thead>
                                    <tr class="text-zinc-500 font-bold uppercase tracking-wider text-left">
                                        <th class="py-3 px-2">Date</th>
                                        <th class="py-3 px-2">Location</th>
                                        <th class="py-3 px-2">Units</th>
                                        <th class="py-3 px-2 text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-zinc-900 text-zinc-300">
                                    @foreach($logs as $log)
                                        <tr class="hover:bg-zinc-950/20 transition-colors">
                                            <td class="py-3 px-2 font-semibold text-zinc-250">{{ $log->donation_date->format('M d, Y') }}</td>
                                            <td class="py-3 px-2 text-zinc-400">{{ $log->location }}</td>
                                            <td class="py-3 px-2">
                                                <span class="px-2 py-0.5 rounded-full bg-red-950/30 text-red-500 border border-red-900/30 font-bold">{{ $log->units }} U</span>
                                            </td>
                                            <td class="py-3 px-2 text-right">
                                                <form method="POST" action="{{ route('dashboard.logs.delete', $log->id) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-400 font-semibold transition-colors" onclick="return confirm('Remove this donation log? This recalculates cooldown status.')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8 text-xs text-zinc-500">
                            No donations logged yet. Log your past donations to earn contribution badges!
                        </div>
                    @endif

                </div>

            </div>

            <!-- RHS: Profile Edit details -->
            <div>
                <div class="bg-zinc-900/40 backdrop-blur-md border border-zinc-800/80 rounded-3xl p-6 md:p-8 shadow-xl tilt-3d">
                    <h2 class="text-lg font-bold font-poppins text-zinc-100 mb-6 flex items-center">
                        <span class="w-2 h-4 bg-red-600 rounded-full mr-2"></span>
                        Update Details
                    </h2>

                    <form method="POST" action="{{ route('dashboard.profile') }}" enctype="multipart/form-data" class="space-y-4 text-xs">
                        @csrf
                        
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-2">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="block w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-xl focus:border-red-500 focus:ring-1 focus:ring-red-500/25 text-zinc-200">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-2">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="block w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-xl focus:border-red-500 focus:ring-1 focus:ring-red-500/25 text-zinc-200">
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-2">Phone Number</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" required class="block w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-xl focus:border-red-500 focus:ring-1 focus:ring-red-500/25 text-zinc-200">
                        </div>

                        <!-- DOB -->
                        <div>
                            <label for="dob" class="block text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-2">Date of Birth</label>
                            <input type="date" name="dob" id="dob" value="{{ old('dob', $user->dob->format('Y-m-d')) }}" required class="block w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-xl focus:border-red-500 focus:ring-1 focus:ring-red-500/25 text-zinc-200">
                        </div>

                        <!-- Gender -->
                        <div>
                            <label for="gender" class="block text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-2">Gender</label>
                            <select name="gender" id="gender" required class="block w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-xl text-zinc-200 cursor-pointer">
                                <option value="Male" {{ old('gender', $user->gender) === 'Male' ? 'selected' : '' }} class="bg-zinc-950">Male</option>
                                <option value="Female" {{ old('gender', $user->gender) === 'Female' ? 'selected' : '' }} class="bg-zinc-950">Female</option>
                                <option value="Other" {{ old('gender', $user->gender) === 'Other' ? 'selected' : '' }} class="bg-zinc-950">Other</option>
                            </select>
                        </div>

                        <!-- Blood group -->
                        <div>
                            <label for="blood_group" class="block text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-2">Blood Group</label>
                            <select name="blood_group" id="blood_group" required class="block w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-xl text-zinc-200 cursor-pointer">
                                <option value="A+" {{ old('blood_group', $user->blood_group) === 'A+' ? 'selected' : '' }} class="bg-zinc-950">A+</option>
                                <option value="A-" {{ old('blood_group', $user->blood_group) === 'A-' ? 'selected' : '' }} class="bg-zinc-950">A-</option>
                                <option value="B+" {{ old('blood_group', $user->blood_group) === 'B+' ? 'selected' : '' }} class="bg-zinc-950">B+</option>
                                <option value="B-" {{ old('blood_group', $user->blood_group) === 'B-' ? 'selected' : '' }} class="bg-zinc-950">B-</option>
                                <option value="AB+" {{ old('blood_group', $user->blood_group) === 'AB+' ? 'selected' : '' }} class="bg-zinc-950">AB+</option>
                                <option value="AB-" {{ old('blood_group', $user->blood_group) === 'AB-' ? 'selected' : '' }} class="bg-zinc-950">AB-</option>
                                <option value="O+" {{ old('blood_group', $user->blood_group) === 'O+' ? 'selected' : '' }} class="bg-zinc-950">O+</option>
                                <option value="O-" {{ old('blood_group', $user->blood_group) === 'O-' ? 'selected' : '' }} class="bg-zinc-950">O-</option>
                            </select>
                        </div>

                        <!-- City -->
                        <div>
                            <label for="city" class="block text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-2">City</label>
                            <input type="text" name="city" id="city" value="{{ old('city', $user->city) }}" required class="block w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-xl focus:border-red-500 focus:ring-1 focus:ring-red-500/25 text-zinc-200">
                        </div>

                        <!-- Avatar -->
                        <div>
                            <label for="avatar" class="block text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-2">Update Avatar</label>
                            <input type="file" name="avatar" id="avatar" accept="image/*" class="block w-full border border-zinc-800 bg-zinc-950 rounded-xl cursor-pointer text-zinc-400 file:bg-zinc-900 file:text-zinc-200 file:border-0 file:py-1.5 file:px-3 file:mr-3 file:text-xs">
                        </div>

                        <!-- Submit -->
                        <div class="pt-4">
                            <button type="submit" class="w-full py-3 px-4 text-xs font-bold text-zinc-200 bg-zinc-950/80 hover:bg-zinc-900 border border-zinc-800 rounded-xl transition-all shadow-md">
                                Save Profile Changes
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>

    </div>
</section>
@endsection
