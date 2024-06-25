<?php

namespace User\Http\Requests;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
use User\Models\UserVerification;

class ChangePasswordRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'currentPassword' => 'required|string|max:191',
            'newPassword' => 'required|string|max:191|confirmed|different:currentPassword'
        ];
    }
}
