<?php

namespace App\Http\Controllers\Sergeant;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AvatarModerationController extends Controller
{
    private function checkRole()
    {
        if (!in_array(Auth::user()->role, ['sergeant', 'admin'])) {
            abort(403, 'Доступ запрещен. Эта страница только для старшины или администратора.');
        }
    }

    public function index()
    {
        $this->checkRole();

        // Получаем только тех, у кого аватарка ждет проверки
        $pendingUsers = User::where('avatar_status', 'pending')->with('profile')->get();
        return view('sergeant.avatars.index', compact('pendingUsers'));
    }

    public function approve(User $user)
    {
        $this->checkRole();

        $user->update(['avatar_status' => 'approved']);
        return back()->with('success', 'Аватарка пользователя одобрена.');
    }

    public function reject(User $user)
    {
        $this->checkRole();

        if ($user->avatar_path) {
            Storage::disk('public')->delete($user->avatar_path);
        }

        $user->update([
            'avatar_path' => null,
            'avatar_status' => 'rejected'
        ]);

        return back()->with('success', 'Аватарка отклонена и удалена.');
    }
}
