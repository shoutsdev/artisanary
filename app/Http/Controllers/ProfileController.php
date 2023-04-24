<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function socialLogin(Request $request)
    {
        try {
            $user = User::where('firebase_auth_id', $request->uid)->orWhere('email',$request->email)->first();
            if ($user) {
                Auth::login($user);
            } else {
                $newUser = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'email_verified_at' => now(),
                    'firebase_auth_id' => $request->uid,
                    'password' => bcrypt('123456dummy'),
                    'role_id' => '1'
                ]);
                Auth::login($newUser);
            }
            return response()->json([
                'success' => 'User logged in successfully',
                'user' => Auth::user(),
                'route' => route('dashboard')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
