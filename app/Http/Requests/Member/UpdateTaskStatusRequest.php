<?php

declare(strict_types=1);

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateTaskStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Pastikan user sudah login
        return auth('web')->check();
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'string'],
        ];
    }
}
