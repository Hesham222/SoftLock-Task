<?php

namespace User\Http\Requests;

class RegisterRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'name' => 'required|string|max:191',
            'email' => 'nullable|email|max:191|unique:users',
            'phone' => ['required', 'unique:users', 'string', 'regex:/^\+?\d+$/', 'max:15'],
            'password' => 'required|string|max:191|confirmed',

        ];
    }

}
