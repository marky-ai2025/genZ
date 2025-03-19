<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
class ProfileController extends Controller {
 
    public function show() {
        $user = User::find(Auth::user()->id);
        $profile = Profile::where('user_id', $user->id)->first(); 

        return view('admin.account', compact('user', 'profile')); 
    }


    public function edit() {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first(); 

        return view('admin.account', compact('user', 'profile'));
    }

   
    public function update(Request $request) {
        $user = Auth::user();
        
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:profiles,email,' . optional($user->profile)->id,
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'about' => 'nullable|string',
            'company' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'twitter_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
        ]);

     
        $profile = Profile::updateOrCreate(
            ['user_id' => $user->id], 
            $request->except(['profile_image']) 
        );

        if ($request->hasFile('profile_image')) {
            if ($profile->profile_image) {
                Storage::disk('public')->delete($profile->profile_image);
            }
            
            $imagePath = $request->file('profile_image')->store('profiles', 'public');
            $profile->update(['profile_image' => $imagePath]);
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully');
    }
}
