<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        return view('profile.edit');
    }

    public function updateAvatar(UpdateAvatarRequest $request): RedirectResponse
    {
        $user = $request->user();

        if ($request->hasFile('avatar')) {
            if ($user->avatar_path) {
                Storage::disk('public')->delete($user->avatar_path);
            }

            $path = $request->file('avatar')->store('avatars', 'public');

            $user->forceFill([
                'avatar_path' => $path,
                'avatar_status' => 'pending',
            ])->save();
        }

        return redirect()->route('profile.edit')->with('success', 'Аватар загружен и отправлен на модерацию.');
    }

    public function destroyAvatar(): RedirectResponse
    {
        $user = auth()->user();

        if ($user->avatar_path) {
            Storage::disk('public')->delete($user->avatar_path);
        }

        $user->forceFill([
            'avatar_path' => null,
            'avatar_status' => 'none',
        ])->save();

        return redirect()->route('profile.edit')->with('success', 'Аватар удален.');
    }
}
