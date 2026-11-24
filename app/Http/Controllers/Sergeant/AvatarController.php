<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($user->avatar_path) {
            Storage::disk('public')->delete($user->avatar_path);
        }

        $path = $request->file('avatar')->store('avatars', 'public');

        // ГЛАВНОЕ: Если роль 'user' -> pending, иначе (старшина, куратор, админ) -> сразу approved
        $status = $user->role === 'user' ? 'pending' : 'approved';

        $user->update([
            'avatar_path' => $path,
            'avatar_status' => $status,
        ]);

        $message = $status === 'pending'
            ? 'Аватарка загружена и отправлена на модерацию старшине.'
            : 'Аватарка успешно установлена.';

        return redirect()->route('dashboard')->with('success', $message);
    }
}
