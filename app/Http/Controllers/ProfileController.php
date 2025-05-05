<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display the user profile
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();
        
        // If profile doesn't exist, create a new one
        if (!$profile) {
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->save();
        }
        
        // Determine user role
        $role = $user->getRoleNames()->first() ?? 'user';
        
        return view('profile.show', compact('user', 'profile', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate input data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore(Auth::id()),
            ],
            'tgl_lahir' => 'required|date',
            'gender' => 'required|in:male,female',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:20',
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }
            
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $profile = Profile::findOrFail($id);
            $user = User::findOrFail($profile->user_id);
            
            // Check if user is authorized to update this profile
            if (Auth::id() !== $profile->user_id && !Auth::user()->hasRole('admin')) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized'
                    ], 403);
                }
                
                return redirect()->back()
                    ->with('error', 'You are not authorized to update this profile.');
            }
            
            // Update user data (name and email)
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            
            // Update profile data
            $profile->tgl_lahir = $request->tgl_lahir;
            $profile->gender = $request->gender;
            $profile->alamat = $request->alamat;
            $profile->nomor_telepon = $request->nomor_telepon;
            
            // Handle profile photo upload
            if ($request->hasFile('foto_profile')) {
                // Delete old profile photo if exists
                if ($profile->foto_profile && !str_starts_with($profile->foto_profile, 'https://picsum.photos')) {
                    Storage::disk('public')->delete($profile->foto_profile);
                }
                
                // Store new profile photo
                $path = $request->file('foto_profile')->store('profile-photos', 'public');
                $profile->foto_profile = Storage::url($path);
            }
            
            $profile->save();
            
            // Prepare response data
            $responseData = [
                'name' => $user->name,
                'email' => $user->email,
                'foto_profile' => $profile->foto_profile,
                'tgl_lahir' => $profile->tgl_lahir,
                'gender' => $profile->gender,
                'alamat' => $profile->alamat,
                'nomor_telepon' => $profile->nomor_telepon,
            ];
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Profile updated successfully',
                    'profile' => $responseData
                ]);
            }
            
            return redirect()->route('profile.show')
                ->with('success', 'Profile updated successfully');
                
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update profile: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()
                ->with('error', 'Failed to update profile: ' . $e->getMessage());
        }
    }
}