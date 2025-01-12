<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $userId = $this->user ? $this->user->id : null;

        $rules = [
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users,email,' . $userId,
            'password' => 'required|min:4',
            'status' => ['required', Rule::in(User::STATUSES)],
            'avatar' => 'nullable|string'
        ];
        if ($userId) $rules['password'] = 'nullable|min:4';

        return $rules;
    }

}
