<?php

namespace User\Http\Requests;

class UpdateFirebaseToken extends BaseRequest
{
    public function rules()
    {
        return [
            'firebase_token' => 'required|string|max:191',
        ];
    }
}
