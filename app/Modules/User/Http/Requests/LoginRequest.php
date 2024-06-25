<?php

namespace User\Http\Requests;

class LoginRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:191',
            'email' => 'nullable|email|max:191|unique:users',
            'deviceType' => 'required|in:Web,Android,IOS',
            'firebaseToken' => 'nullable|string|max:65000',
        ];
    }
}
