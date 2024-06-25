<?php

namespace User\Http\Middleware;

use Closure;
use Illuminate\Http\Exceptions\HttpResponseException;
use User\Http\Controllers\BaseResponse;

class Authorized
{

    public function handle($request, Closure $next)
    {

        if(auth()->guard('api')->check())
            return $next($request->merge(['activeGuard'=>'api']));
        $response = new BaseResponse();
        throw new HttpResponseException($response->response(101, 'Validation Error', 200, ['User not authorized']));
    }
}
