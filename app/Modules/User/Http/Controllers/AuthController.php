<?php

namespace User\Http\Controllers;

use App\Events\User\UserLoggedIn;
use App\Services\SmsService;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use User\Http\Requests\ChangeForgotPasswordRequest;
use User\Http\Requests\ForgotPasswordRequest;
use User\Http\Requests\LoginProviderRequest;
use User\Http\Requests\VerifyForgotCodeRequest;
use User\Mail\VerifyUser;
use User\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use User\Http\Requests\LoginRequest;
use User\Http\Requests\RegisterRequest;
use User\Http\Requests\ResendCodeRequest;
use User\Http\Requests\VerifyUserRequest;
use User\Http\Resources\UserResource;
use User\Models\UserVerification;
use User\Actions\RegisterAction;


class AuthController extends BaseResponse
{

    protected $smsService;


    public function listCodes()
    {
        return UserVerification::select('user_id', 'code', 'codeType')->orderBy('id', 'DESC')->take(6)->get();
    }

    public function register(RegisterRequest $request ,RegisterAction $registerAction)
    {
        DB::beginTransaction();
        try {
            $record = $registerAction->execute($request);
            //dd($record);
            $code = rand(1000,9999);
            UserVerification::create([
                'code'               => $code,
                'user_id'           => $record->id,
                'codeType'           => 'Verify',
            ]);
            //Mail::to($record)->send(new VerifyUser($record, $code));
            //$this->smsService->sendSMS($record->phone, $code . ' is your code');
            DB::commit();
            return $this->response(200, 'Verification code has been sent succssfully. ', 200, [], $record->id,
                [
                    'userType'      => 'User',
                ]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }



    public function login(LoginRequest $request)
    {
        DB::beginTransaction();
        try {
            if (
                auth()->attempt([
                    'email' => $request->input('name'),
                    'password' => $request->input('password')])
                ||
                auth()->attempt([
                    'phone' => $request->input('name'),
                    'password' => $request->input('password')])) {

                $user = auth()->user();

                $user->deviceType = $request->input('deviceType');
                $user->firebaseToken = $request->input('firebaseToken');
                if (!$user->api_token) {
                    $user->api_token = Str::random(80);
                }
                $user->save();
                event(new UserLoggedIn($user));

                DB::commit();
                return $this->response(200, $user->api_token, 200, [], 0, [
                    'user' => new UserResource($user),
                ]);
            }
            return $this->response(101, 'Validation Error', 200, [__('auth.failed')]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->response(500, $e->getMessage(), 500);
        }
    }



    public function logout()
    {
        $user = auth('api')->user();
        $user->api_token = null;
        $user->save();
        return $this->response(200, __('User::messages.loggedOut'), 200);
    }
}
