<?php

namespace App\Http\Requests\Curator;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'date_of_birth' => ['nullable', 'date'],
            'course' => ['required', 'integer', 'min:1', 'max:5'],
            'group_name' => ['required', 'string', 'max:50'],
        ];
    }
}
