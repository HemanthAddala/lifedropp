<?php

namespace App\Http\Controllers;

use App\Models\BloodRequest;
use App\Models\User;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        // Compute statistics counts
        $donorsCount = User::where('role', 'donor')->count();
        $livesSaved = BloodRequest::where('status', 'resolved')->count() + 184; // base realistic counter + DB resolved
        $hospitalsCount = 18; // Mock partnered count

        // Fetch top 3 active urgent requests to highlight on home page
        $urgentRequests = BloodRequest::where('is_approved', true)
            ->where('status', 'active')
            ->orderBy('urgency', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('landing', compact('donorsCount', 'livesSaved', 'hospitalsCount', 'urgentRequests'));
    }

    public function search(Request $request)
    {
        $bloodGroup = $request->input('blood_group');
        $city = $request->input('city');

        $query = User::where('role', 'donor');

        if ($bloodGroup) {
            $query->where('blood_group', $bloodGroup);
        }

        if ($city) {
            $query->where('city', 'like', '%'.$city.'%');
        }

        // Fetch matched donors: active ones first
        $donors = $query->orderBy('is_available', 'desc')
            ->orderBy('name', 'asc')
            ->get();

        return view('search', compact('donors', 'bloodGroup', 'city'));
    }
}
