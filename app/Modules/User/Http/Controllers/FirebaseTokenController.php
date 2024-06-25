<?php

namespace User\Http\Controllers;
use User\Http\Requests\UpdateFirebaseToken;
use User\Http\Resources\UserResource;
use Illuminate\Support\Facades\DB;

class FirebaseTokenController extends BaseResponse
{
    public function __invoke(UpdateFirebaseToken $request)
    {
        DB::beginTransaction();
        try {
            $user = auth('api')->user();
            $user->firebaseToken = $request->input('firebase_token');
            $user->save();
            DB::commit();
            return $this->response(200, __('User::messages.firebaseTokenUpdated'), 200, [], 0, [
                'user' => new UserResource($user),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }
}
