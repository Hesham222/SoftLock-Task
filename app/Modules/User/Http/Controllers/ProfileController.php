<?php

namespace User\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use User\Http\Requests\ChangePasswordRequest;
use User\Http\Requests\UpdateProfileRequest;
use User\Http\Resources\UserResource;
use Illuminate\Support\Facades\DB;

class ProfileController extends BaseResponse
{
    public function index()
    {
        return $this->response(200,__('User::messages.profileDetails'), 200, [], 0, [
            'user' => new UserResource(auth()->user()),
        ]);
    }

    public function update(UpdateProfileRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = auth('api')->user();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->save();
            DB::commit();
            return $this->response(200, __('User::messages.profileUpdated'), 200, [], 0, [
                'user' => new UserResource($user),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = auth('api')->user();
            if (Hash::check($request->input('currentPassword'), $user->password)) {
                $user->password = bcrypt($request->input('newPassword'));
                $user->save();
                DB::commit();
                return $this->response(200, __('User::messages.passwordChanged'), 200, [], 0, [
                    'user' => new UserResource($user),
                ]);
            }
            return $this->response(101, 'Validation Error', 200, [__('User::messages.invalidCurrentPassword')]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }
}
