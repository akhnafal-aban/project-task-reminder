<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        // Hanya admin dan anggota proyek yang bisa membuat tugas
        $user = $this->user();
        return $user && ($user->isAdmin());
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => ['required', Rule::in(['admin', 'member'])],
        ];
    }

    public function messages()
    {
        return [
            'role.in' => 'Role harus admin atau member.',
        ];
    }
}
