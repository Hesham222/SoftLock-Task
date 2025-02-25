<?php

namespace User\Http\Requests;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
use User\Models\UserVerification;

class VerifyForgotCodeRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'user_id' => ['required', Rule::exists('users', 'id')->where('isVerified', 1)],
            'code' => ['required', 'string', Rule::exists('user_verifications')->where(function ($query) {
                $query->where('id', UserVerification::where('user_id', $this->input('user_id'))->orderBy('created_at', 'desc')->value('id'))
                    ->where('codeType', 'Forget')
                    ->where('created_at', '>', Carbon::now()->subMinutes(5)->format('Y-m-d H:i:s'));
            })],
        ];
    }

}
