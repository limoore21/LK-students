<?php

namespace App\Http\Controllers\Curator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Curator\UpdateStudentProfileRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StudentProfileController extends Controller
{
    public function index(): View
    {
        $students = User::where('role', 'user')->with('profile')->get();
        return view('curator.students.index', compact('students'));
    }

    public function edit(User $user): View
    {
        return view('curator.students.edit', compact('user'));
    }

    public function update(UpdateStudentProfileRequest $request, User $user): RedirectResponse
    {
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $request->validated()
        );

        return redirect()->route('curator.students.index')->with('success', 'Профиль обновлен');
    }
}
