<?php

namespace User\Http\Requests;

use Illuminate\Validation\Rule;

class ResendCodeRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'user_id' => ['required', Rule::exists('users', 'id')],
        ];
    }
}
