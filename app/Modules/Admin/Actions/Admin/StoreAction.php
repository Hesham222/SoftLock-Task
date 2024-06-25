<?php
namespace Admin\Actions\Admin;
use Illuminate\Http\Request;
use Admin\Models\{
    Admin
};
class StoreAction
{
    public function execute(Request $request): void
    {
        $record =  Admin::create([
            'name'       => $request->input('name'),
            'email'      => $request->input('email'),
            'phone'      => $request->input('phone'),
            'privileges'  => $request->input('privilege'),
            'password'   => bcrypt($request->input('password')),
            'created_by' => auth('admin')->user()->id,
        ]);

    }
}
