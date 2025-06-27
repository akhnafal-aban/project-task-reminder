<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class AssignProjectMembersRequest extends FormRequest
{
    public function authorize()
    {
        // Only allow if user is admin
        return Gate::allows('assign-project-members', $this->route('project'));
    }

    public function rules()
    {
        return [
            'members' => 'required|array',
            'members.*' => 'exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'members.required' => 'Pilih minimal satu anggota.',
            'members.*.exists' => 'Anggota yang dipilih tidak valid.',
        ];
    }
}
