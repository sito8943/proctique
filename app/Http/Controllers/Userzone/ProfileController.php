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
            'avatar' => ['nullable', 'image', 'max:' . config('uploads.max_image_kb', 2048)],
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

        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
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

        // Mark user as deleted using common method
        $user->markAsDeleted();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
