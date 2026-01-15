<?php

namespace App\Http\Controllers\Userzone;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
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
        return view('userzone.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Update basic info
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        // Validate and handle avatar upload/removal
        $request->validate([
            'avatar' => ['nullable', 'image'],
            'avatar_remove' => ['nullable', 'boolean'],
        ]);

        $user = $request->user();

        if ($request->boolean('avatar_remove')) {
            $user->media->each->delete();
        }

        if ($request->hasFile('avatar')) {
            // Replace existing avatar with new upload
            $user->media->each->delete();
            $user->addMediaFromRequest('avatar')->toMediaCollection();
        }

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

        // Update email to free up the original, avoiding unique constraint
        $suffix = '__deleted__' . $user->id;
        // email column is 255 by default; ensure we don't exceed it
        $maxLen = 255;
        $base = substr($user->email, 0, max(0, $maxLen - strlen($suffix)));
        $user->email = $base . $suffix;
        $user->save();

        Auth::logout();

        // Soft delete the user (SoftDeletes on User model)
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
