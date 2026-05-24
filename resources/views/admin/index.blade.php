@extends('layouts.app')

@section('title', 'Admin Command Center - Lifedrop')

@section('content')
<section class="py-12 bg-gradient-to-b from-[#020203] via-[#09090B] to-[#020203] min-h-screen relative z-10">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        
        <!-- Welcome admin header -->
        <div class="mb-10">
            <span class="text-xs font-bold text-red-500 uppercase tracking-wider">Administrative Suite</span>
            <h1 class="text-3xl font-extrabold font-poppins text-zinc-100 mt-1">Admin Command Center</h1>
            <p class="text-sm text-zinc-400 mt-2">Manage registered system accounts and moderate the emergency crisis requests board.</p>
        </div>

        <!-- Summary Statistics Panels -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10 text-xs">
            <div class="bg-zinc-900/40 backdrop-blur-md border border-zinc-800/80 p-5 rounded-2xl shadow-lg">
                <span class="text-zinc-450 font-bold uppercase tracking-wider block">Total Members</span>
                <span class="text-2xl font-extrabold text-zinc-100 block mt-2 font-poppins">{{ $users->count() }}</span>
            </div>
            <div class="bg-zinc-900/40 backdrop-blur-md border border-zinc-800/80 p-5 rounded-2xl shadow-lg">
                <span class="text-zinc-450 font-bold uppercase tracking-wider block">Active Crises</span>
                <span class="text-2xl font-extrabold text-red-500 block mt-2 font-poppins">{{ $requests->where('status', 'active')->count() }}</span>
            </div>
            <div class="bg-zinc-900/40 backdrop-blur-md border border-zinc-800/80 p-5 rounded-2xl shadow-lg">
                <span class="text-zinc-450 font-bold uppercase tracking-wider block">Approved Board Posts</span>
                <span class="text-2xl font-extrabold text-emerald-400 block mt-2 font-poppins">{{ $requests->where('is_approved', true)->count() }}</span>
            </div>
            <div class="bg-zinc-900/40 backdrop-blur-md border border-zinc-800/80 p-5 rounded-2xl shadow-lg">
                <span class="text-zinc-450 font-bold uppercase tracking-wider block">System Administrators</span>
                <span class="text-2xl font-extrabold text-cyan-400 block mt-2 font-poppins">{{ $users->where('role', 'admin')->count() }}</span>
            </div>
        </div>

        <!-- Section A: Emergency Requests Moderation Table -->
        <div class="bg-zinc-900/40 backdrop-blur-md border border-zinc-800/80 rounded-3xl p-6 md:p-8 shadow-xl mb-10">
            <h2 class="text-lg font-bold font-poppins text-zinc-100 mb-6 flex items-center">
                <span class="w-2 h-4 bg-red-600 rounded-full mr-2"></span>
                Public Crisis Requests Moderation
            </h2>

            @if($requests->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-800/80 text-xs">
                        <thead>
                            <tr class="text-zinc-500 font-bold uppercase tracking-wider text-left">
                                <th class="py-3 px-2">Patient</th>
                                <th class="py-3 px-2">Blood / Units</th>
                                <th class="py-3 px-2">Hospital</th>
                                <th class="py-3 px-2">Contact Person</th>
                                <th class="py-3 px-2">Urgency</th>
                                <th class="py-3 px-2">Feed Visibility</th>
                                <th class="py-3 px-2 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-900 text-zinc-350">
                            @foreach($requests as $req)
                                <tr class="hover:bg-zinc-950/10 transition-colors">
                                    <td class="py-4 px-2 font-semibold text-zinc-200">{{ $req->patient_name }}</td>
                                    <td class="py-4 px-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-bold bg-red-950/30 text-red-400 border border-red-900/30">
                                            {{ $req->blood_group }} | {{ $req->units }} U
                                        </span>
                                    </td>
                                    <td class="py-4 px-2">
                                        <p class="font-bold text-zinc-300">{{ $req->hospital_name }}</p>
                                        <p class="text-[10px] text-zinc-500 mt-0.5 truncate max-w-[150px]">{{ $req->hospital_address }}, {{ $req->city }}</p>
                                    </td>
                                    <td class="py-4 px-2">
                                        <p class="font-semibold text-zinc-300">{{ $req->contact_person }}</p>
                                        <p class="font-mono text-[10px] text-zinc-500 mt-0.5">{{ $req->contact_phone }}</p>
                                    </td>
                                    <td class="py-4 px-2">
                                        @if($req->urgency === 'urgent')
                                            <span class="px-2.5 py-0.5 rounded-full bg-red-950/40 text-red-400 border border-red-900/40 font-bold text-[9px] uppercase tracking-wider animate-pulse">Urgent</span>
                                        @else
                                            <span class="px-2.5 py-0.5 rounded-full bg-zinc-950/60 text-zinc-400 border border-zinc-800 font-semibold text-[9px] uppercase tracking-wider">Normal</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-2">
                                        @if($req->is_approved)
                                            <span class="inline-flex items-center text-emerald-400 font-semibold">
                                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5 glowing-dot-active"></span>
                                                Approved
                                            </span>
                                        @else
                                            <span class="inline-flex items-center text-red-500 font-semibold">
                                                <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span>
                                                Disapproved
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-2 text-right">
                                        <div class="flex items-center justify-end space-x-4">
                                            <!-- Toggle Approve Form -->
                                            <form method="POST" action="{{ route('admin.requests.toggle-approve', $req->id) }}" class="inline">
                                                @csrf
                                                <button type="submit" class="text-xs font-semibold transition-colors {{ $req->is_approved ? 'text-zinc-450 hover:text-zinc-300' : 'text-emerald-450 hover:text-emerald-350' }}">
                                                    {{ $req->is_approved ? 'Disapprove' : 'Approve' }}
                                                </button>
                                            </form>
                                            
                                            <!-- Delete Request Form -->
                                            <form method="POST" action="{{ route('admin.requests.delete', $req->id) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs font-bold text-red-500 hover:text-red-400 transition-colors" onclick="return confirm('Permanently remove this crisis request?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8 text-xs text-zinc-500">
                    No emergency requests found in the system registry.
                </div>
            @endif
        </div>

        <!-- Section B: Users Database Registry Table -->
        <div class="bg-zinc-900/40 backdrop-blur-md border border-zinc-800/80 rounded-3xl p-6 md:p-8 shadow-xl">
            <h2 class="text-lg font-bold font-poppins text-zinc-100 mb-6 flex items-center">
                <span class="w-2 h-4 bg-red-600 rounded-full mr-2"></span>
                System Accounts Registry
            </h2>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-zinc-800/80 text-xs">
                    <thead>
                        <tr class="text-zinc-500 font-bold uppercase tracking-wider text-left">
                            <th class="py-3 px-2">Member</th>
                            <th class="py-3 px-2">Blood Group</th>
                            <th class="py-3 px-2">City</th>
                            <th class="py-3 px-2">Phone</th>
                            <th class="py-3 px-2">Role</th>
                            <th class="py-3 px-2">Availability</th>
                            <th class="py-3 px-2 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-900 text-zinc-350">
                        @foreach($users as $usr)
                            <tr class="hover:bg-zinc-950/10 transition-colors">
                                <td class="py-4 px-2">
                                    <div class="flex items-center space-x-3">
                                        @if($usr->avatar)
                                            <img class="w-8 h-8 rounded-lg object-cover" src="{{ asset($usr->avatar) }}" alt="{{ $usr->name }}">
                                        @else
                                            <div class="w-8 h-8 rounded-lg bg-red-950/40 border border-red-900/35 text-red-500 flex items-center justify-center font-bold">
                                                {{ strtoupper(substr($usr->name, 0, 2)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <p class="font-bold text-zinc-200">{{ $usr->name }}</p>
                                            <p class="text-[10px] text-zinc-500 mt-0.5">{{ $usr->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-2">
                                    <span class="px-2 py-0.5 rounded bg-red-950/30 text-red-400 border border-red-900/30 font-bold">{{ $usr->blood_group }}</span>
                                </td>
                                <td class="py-4 px-2 font-semibold text-zinc-350">{{ $usr->city }}</td>
                                <td class="py-4 px-2 font-mono text-zinc-400">{{ $usr->phone }}</td>
                                <td class="py-4 px-2">
                                    @if($usr->role === 'admin')
                                        <span class="px-2 py-0.5 rounded bg-cyan-950/40 border border-cyan-900/40 text-cyan-400 font-bold uppercase text-[9px] tracking-wider">Admin</span>
                                    @else
                                        <span class="px-2 py-0.5 rounded bg-zinc-950/60 border border-zinc-800 text-zinc-400 font-bold uppercase text-[9px] tracking-wider">Donor</span>
                                    @endif
                                </td>
                                <td class="py-4 px-2">
                                    @if($usr->is_available)
                                        <span class="text-emerald-455 font-medium flex items-center">
                                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full glowing-dot-active mr-1.5"></span>
                                            Available
                                        </span>
                                    @else
                                        <span class="text-zinc-500 flex items-center">
                                            <span class="w-1.5 h-1.5 bg-zinc-600 rounded-full mr-1.5"></span>
                                            Offline / Rest
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-2 text-right">
                                    <div class="flex items-center justify-end space-x-3">
                                        @if($usr->id !== auth()->id())
                                            <!-- Delete User Form Only (Toggle Role Button Form Removed completely) -->
                                            <form method="POST" action="{{ route('admin.users.delete', $usr->id) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs font-bold text-red-500 hover:text-red-400 transition-colors" onclick="return confirm('Permanently remove this account and all their logs?')">
                                                     Delete
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-zinc-500 italic text-[11px]">Active Session</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>
@endsection
