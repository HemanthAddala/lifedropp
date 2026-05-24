<?php

namespace App\Http\Controllers;

use App\Models\BloodRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function index()
    {
        // Fetch approved active crisis posts
        $requests = BloodRequest::where('is_approved', true)
            ->where('status', 'active')
            ->orderByRaw("CASE WHEN urgency = 'urgent' THEN 1 ELSE 2 END")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('requests.index', compact('requests'));
    }

    public function create()
    {
        return view('requests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_name' => 'required|string|max:255',
            'blood_group' => 'required|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'units' => 'required|integer|min:1|max:50',
            'hospital_name' => 'required|string|max:255',
            'hospital_address' => 'required|string',
            'city' => 'required|string|max:100',
            'contact_person' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:20',
            'urgency' => 'required|string|in:urgent,normal',
        ]);

        BloodRequest::create([
            'user_id' => Auth::id(),
            'patient_name' => $request->patient_name,
            'blood_group' => $request->blood_group,
            'units' => $request->units,
            'hospital_name' => $request->hospital_name,
            'hospital_address' => $request->hospital_address,
            'city' => $request->city,
            'contact_person' => $request->contact_person,
            'contact_phone' => $request->contact_phone,
            'urgency' => $request->urgency,
            'is_approved' => true, // Auto-approved for registered users
            'status' => 'active',
        ]);

        return redirect()->route('requests.index')->with('success', 'Emergency crisis request posted successfully! The public and matching donors are being notified.');
    }

    public function donate($id)
    {
        $bloodRequest = BloodRequest::findOrFail($id);

        // Simulate notification dispatch hook
        $seekerName = $bloodRequest->contact_person;
        $patient = $bloodRequest->patient_name;
        $bloodGroup = $bloodRequest->blood_group;

        $msg = "Heartwarming! An automated connection dispatch notification has been sent via SMS/WhatsApp to {$seekerName} for Patient {$patient} ({$bloodGroup}). They will contact you immediately.";

        return redirect()->back()->with('success', $msg);
    }
}
