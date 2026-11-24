<?php

namespace App\Http\Controllers\Curator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentProfileController extends Controller
{
    private function checkRole()
    {
        if (Auth::user()->role !== 'curator' && Auth::user()->role !== 'admin') {
            abort(403, 'Доступ запрещен. Только для классного руководителя.');
        }
    }

    public function index()
    {
        $this->checkRole();

        $students = User::where('role', 'user')
            ->with('profile')
            ->orderBy('name')
            ->get();

        return view('curator.students.index', compact('students'));
    }

    public function edit(User $user)
    {
        $this->checkRole();

        // Проверяем, что это действительно курсант
        if ($user->role !== 'user') {
            abort(404, 'Пользователь не найден');
        }

        return view('curator.students.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->checkRole();

        if ($user->role !== 'user') {
            abort(404, 'Пользователь не найден');
        }

        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'course' => 'required|integer|min:1|max:6',
            'group_name' => 'required|string|max:50',
        ]);

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return redirect()->route('curator.students.index')
            ->with('success', 'Профиль курсанта обновлён');
    }
}
