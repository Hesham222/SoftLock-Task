<?php

namespace User\Http\Requests;

class LoginProviderRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'token' => 'required|string',
            'from' => 'required|in:facebook,google,apple',
            'deviceType' => 'required|in:Web,Android,IOS',
            'firebaseToken' => 'nullable|string|max:65000',
        ];
    }
}
