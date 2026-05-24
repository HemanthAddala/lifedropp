<?php

namespace App\Http\Controllers;

use App\Models\DonationLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DonorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $logs = $user->donationLogs;
        $cooldownDays = $user->cooldownDays();
        $badgeTier = $user->badgeTier();

        return view('dashboard', compact('user', 'logs', 'cooldownDays', 'badgeTier'));
    }

    public function toggleAvailability(Request $request)
    {
        $user = Auth::user();
        $user->is_available = ! $user->is_available;
        $user->save();

        $statusText = $user->is_available ? 'Available' : 'Unavailable';

        return redirect()->route('dashboard')->with('success', 'Your emergency availability status is now toggled to: '.$statusText.'.');
    }

    public function addLog(Request $request)
    {
        $request->validate([
            'donation_date' => 'required|date|before_or_equal:tomorrow',
            'location' => 'required|string|max:255',
            'units' => 'nullable|integer|min:1|max:10',
        ]);

        $user = Auth::user();

        DonationLog::create([
            'user_id' => $user->id,
            'donation_date' => $request->donation_date,
            'location' => $request->location,
            'units' => $request->units ?? 1,
        ]);

        return redirect()->route('dashboard')->with('success', 'New blood donation log recorded successfully. Cooldown countdown and contribution tier badges have been re-computed.');
    }

    public function deleteLog($id)
    {
        $user = Auth::user();
        $log = DonationLog::where('user_id', $user->id)->findOrFail($id);
        $log->delete();

        return redirect()->route('dashboard')->with('success', 'Donation log removed successfully.');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'required|string|max:20|unique:users,phone,'.$user->id,
            'dob' => 'required|date|before_or_equal:today -18 years',
            'gender' => 'required|string|in:Male,Female,Other',
            'city' => 'required|string|max:100',
            'blood_group' => 'required|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'dob.before_or_equal' => 'You must be at least 18 years old.',
        ]);

        $avatarPath = $user->avatar;
        if ($request->hasFile('avatar')) {
            // Delete old avatar file if exists
            if ($user->avatar && File::exists(public_path($user->avatar))) {
                File::delete(public_path($user->avatar));
            }

            $file = $request->file('avatar');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/avatars'), $filename);
            $avatarPath = 'uploads/avatars/'.$filename;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'city' => $request->city,
            'blood_group' => $request->blood_group,
            'avatar' => $avatarPath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Your profile details have been updated successfully.');
    }
}
