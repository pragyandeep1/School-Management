<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SettingsController extends Controller
{
    public function adminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile', compact('profileData'));
    }// end function

    public function adminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->save();

        $notification = array(
            'message'       => 'Admin profile updated successfully',
            'alert-type'    => 'success'
        );

        return redirect()->back()->with($notification);
    }// end function

    public function adminSettings()
    {
        return view('admin.admin_settings');
    }

    public function update(Request $request)
    {
        // Validate the request data
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Get the authenticated user (assuming you're using Laravel's built-in authentication)
        $user = auth()->user();

        // Check if the provided current password matches the user's actual password
        if (password_verify($request->input('current_password'), $user->password)) {
            // Hash and save the new password
            $user->password = bcrypt($request->input('new_password'));
            $user->save();

            return redirect()->route('settings')->with('success', 'Password updated successfully.');
        } else {
            return redirect()->route('settings')->with('error', 'Current password is incorrect.');
        }
    }


    public function adminActivity()
    {
        $activityLog = User::latest()->get();
        return view('admin.admin_activity', compact('activityLog'));
    }

}
