<?php

namespace Admin\Http\Controllers;
use User\Models\{
    User,
};


class DashboardController extends JsonResponse
{
    public function __invoke()
    {
        return view('Admin::home');
    }
}
