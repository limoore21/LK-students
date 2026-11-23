<?php

namespace App\Http\Controllers\Sergeant;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AvatarModerationController extends Controller
{
    public function index(): View
    {
        $pendingUsers = User::where('avatar_status', 'pending')->get();
        return view('sergeant.avatars.index', compact('pendingUsers'));
    }

    public function approve(User $user): RedirectResponse
    {
        $user->update(['avatar_status' => 'approved']);
        return redirect()->back()->with('success', 'Аватар одобрен.');
    }

    public function reject(User $user): RedirectResponse
    {
        if ($user->avatar_path) {
            Storage::disk('public')->delete($user->avatar_path);
        }

        $user->update([
            'avatar_path' => null,
            'avatar_status' => 'rejected',
        ]);

        return redirect()->back()->with('success', 'Аватар отклонен и удален.');
    }
}
