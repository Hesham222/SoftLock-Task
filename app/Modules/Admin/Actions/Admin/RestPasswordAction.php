<?php
namespace Admin\Actions\Admin;;
use Illuminate\Http\Request;
use Admin\Models\{
    Admin
};

class RestPasswordAction
{
    public function execute(Request $request): void
    {
        $record = Admin::find($request->resource_id);
        $record->password            = bcrypt($request->password);
        $record->save();
    }
}
