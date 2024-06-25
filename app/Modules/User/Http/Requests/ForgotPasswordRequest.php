<?php

namespace User\Http\Requests;

class ForgotPasswordRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'phone' => ['required_without:email', 'string', 'exists:users'],
            'email' => ['required_without:phone', 'email', 'exists:users']
        ];
    }

}
