<?php

namespace App\Http\Controllers;

use App\Models\BloodRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::orderBy('role', 'desc')->orderBy('name', 'asc')->get();
        $requests = BloodRequest::orderBy('created_at', 'desc')->get();

        return view('admin.index', compact('users', 'requests'));
    }

    public function toggleApprove($id)
    {
        $request = BloodRequest::findOrFail($id);
        $request->is_approved = ! $request->is_approved;
        $request->save();

        $statusText = $request->is_approved ? 'Approved and Visible' : 'Disapproved and Hidden';

        return redirect()->route('admin.index')->with('success', 'Emergency request status updated to: '.$statusText.'.');
    }

    public function deleteRequest($id)
    {
        $request = BloodRequest::findOrFail($id);
        $request->delete();

        return redirect()->route('admin.index')->with('success', 'Emergency request has been pulled down and deleted successfully.');
    }

    public function toggleRole($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return redirect()->route('admin.index')->with('error', 'You cannot change your own administrator role.');
        }

        $user->role = ($user->role === 'admin') ? 'donor' : 'admin';
        $user->save();

        return redirect()->route('admin.index')->with('success', 'User '.$user->name.' has been updated to role: '.strtoupper($user->role).'.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return redirect()->route('admin.index')->with('error', 'For safety, you cannot delete your own active administrator session.');
        }

        $user->delete();

        return redirect()->route('admin.index')->with('success', 'Spam/suspicious user account has been successfully removed.');
    }
}
