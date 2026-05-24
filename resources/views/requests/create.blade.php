@extends('layouts.app')

@section('title', 'Post an Emergency Blood Crisis - Lifedrop')

@section('content')
<section class="py-12 bg-gradient-to-b from-[#020203] via-[#09090B] to-[#020203] min-h-screen flex items-center relative z-10">
    <div class="px-4 mx-auto max-w-xl w-full">
        <div class="bg-zinc-900/40 backdrop-blur-md border border-zinc-800/80 rounded-3xl p-8 shadow-2xl">
            <!-- Header -->
            <div class="mb-8">
                <span class="text-xs font-bold text-red-500 uppercase tracking-wider block">Crisis Declaration</span>
                <h1 class="text-2xl font-bold font-poppins text-zinc-100 mt-1">Declare a Blood Crisis</h1>
                <p class="text-xs text-zinc-400 mt-1.5 leading-relaxed">Provide detailed patient and hospital location criteria. Registered donors matching your location will be notified.</p>
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
            <form method="POST" action="{{ route('requests.store') }}" class="space-y-5 text-xs text-zinc-300">
                @csrf

                <!-- Patient Name -->
                <div>
                    <label for="patient_name" class="block text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-2">Patient Name</label>
                    <input type="text" name="patient_name" id="patient_name" value="{{ old('patient_name') }}" required placeholder="e.g. John Miller" class="block w-full px-4 py-3 bg-zinc-950 border border-zinc-800 rounded-xl focus:border-red-500 focus:ring-1 focus:ring-red-500/25 text-xs text-zinc-200 placeholder-zinc-650">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Blood Group -->
                    <div>
                        <label for="blood_group" class="block text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-2">Blood Group Needed</label>
                        <select name="blood_group" id="blood_group" required class="block w-full px-4 py-3 bg-zinc-950 border border-zinc-800 rounded-xl text-xs text-zinc-200 cursor-pointer">
                            <option value="" class="bg-zinc-950">Select Group</option>
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

                    <!-- Required Units -->
                    <div>
                        <label for="units" class="block text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-2">Units Required</label>
                        <input type="number" name="units" id="units" min="1" max="100" value="{{ old('units', 1) }}" required class="block w-full px-4 py-3 bg-zinc-950 border border-zinc-800 rounded-xl focus:border-red-500 focus:ring-1 focus:ring-red-500/25 text-xs text-zinc-200">
                    </div>
                </div>

                <!-- Hospital Name -->
                <div>
                    <label for="hospital_name" class="block text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-2">Hospital Name</label>
                    <input type="text" name="hospital_name" id="hospital_name" value="{{ old('hospital_name') }}" required placeholder="e.g. St. Jude Hospital" class="block w-full px-4 py-3 bg-zinc-950 border border-zinc-800 rounded-xl focus:border-red-500 focus:ring-1 focus:ring-red-500/25 text-xs text-zinc-200 placeholder-zinc-650">
                </div>

                <!-- Hospital Address -->
                <div>
                    <label for="hospital_address" class="block text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-2">Hospital Address</label>
                    <textarea name="hospital_address" id="hospital_address" rows="3" required placeholder="e.g. 520 Medical Plaza, Ave 5" class="block w-full px-4 py-3 bg-zinc-950 border border-zinc-800 rounded-xl focus:border-red-500 focus:ring-1 focus:ring-red-500/25 text-xs text-zinc-200 placeholder-zinc-650">{{ old('hospital_address') }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- City -->
                    <div>
                        <label for="city" class="block text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-2">City</label>
                        <input type="text" name="city" id="city" value="{{ old('city') }}" required placeholder="e.g. Chicago" class="block w-full px-4 py-3 bg-zinc-950 border border-zinc-800 rounded-xl focus:border-red-500 focus:ring-1 focus:ring-red-500/25 text-xs text-zinc-200 placeholder-zinc-650">
                    </div>

                    <!-- Urgency Level -->
                    <div>
                        <label for="urgency" class="block text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-2">Urgency Level</label>
                        <select name="urgency" id="urgency" required class="block w-full px-4 py-3 bg-zinc-950 border border-zinc-800 rounded-xl text-xs text-zinc-200 cursor-pointer">
                            <option value="urgent" {{ old('urgency') === 'urgent' ? 'selected' : '' }} class="bg-zinc-950">Urgent (Requires immediate dispatch)</option>
                            <option value="normal" {{ old('urgency') === 'normal' ? 'selected' : '' }} class="bg-zinc-950">Normal (Surgical reserve/Scheduled)</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 pt-4 border-t border-zinc-800/80">
                    <!-- Contact Person -->
                    <div>
                        <label for="contact_person" class="block text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-2">Contact Person</label>
                        <input type="text" name="contact_person" id="contact_person" value="{{ old('contact_person') }}" required placeholder="e.g. Alice Miller" class="block w-full px-4 py-3 bg-zinc-950 border border-zinc-800 rounded-xl focus:border-red-500 focus:ring-1 focus:ring-red-500/25 text-xs text-zinc-200 placeholder-zinc-650">
                    </div>

                    <!-- Contact Phone -->
                    <div>
                        <label for="contact_phone" class="block text-[10px] font-bold text-zinc-400 uppercase tracking-wider mb-2">Contact Phone Number</label>
                        <input type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone') }}" required placeholder="e.g. +1 (555) 789-0123" class="block w-full px-4 py-3 bg-zinc-950 border border-zinc-800 rounded-xl focus:border-red-500 focus:ring-1 focus:ring-red-500/25 text-xs text-zinc-200 placeholder-zinc-650">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="w-full py-4 px-4 text-xs font-bold text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 rounded-xl shadow-lg shadow-red-950/40 transition-all flex items-center justify-center gap-2 border border-red-500/20">
                        <svg class="w-4 h-4 text-white fill-current animate-bounce" viewBox="0 0 24 24">
                            <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z" />
                        </svg>
                        Broadcast Crisis Immediately
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
