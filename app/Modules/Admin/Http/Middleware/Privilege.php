<?php

namespace Admin\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Privilege
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next = null, ...$privileges)
    {
        if (Auth::guard('admin')->check() && in_array(Auth::guard('admin')->user()->privileges, $privileges)) {
            return $next($request);
        } else {
            switch ($privileges[0]) {
                case 'manager';
                    return redirect()->route('managers.login');
                    break;
                default;
                    return redirect()->route('admins.login');
            }
        }
    }
}
