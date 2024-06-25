<?php
namespace User\Actions;

use User\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;

class RegisterAction
{
    public function execute(Request $request)
    {
        $user = User::create([
            'name'           => $request->input('name'),
            'phone'                => $request->input('phone'),
            'email'                => $request->input('email'),
            'password'             => bcrypt($request->input('password')),
        ]);
        return $user;
    }
}
