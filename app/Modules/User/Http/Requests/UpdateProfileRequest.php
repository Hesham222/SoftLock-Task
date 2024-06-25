<?php

namespace User\Http\Requests;

class UpdateProfileRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:191',
            'email' => 'nullable|email|max:191|unique:users,email,' . auth('api')->user()->id,
            'phone' => ['required', 'unique:users,phone,' . auth('api')->user()->id, 'string', 'regex:/^\+?\d+$/', 'max:15']
        ];
    }
}
