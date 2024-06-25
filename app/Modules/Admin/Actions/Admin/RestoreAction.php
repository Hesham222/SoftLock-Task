<?php
namespace Admin\Actions\Admin;;
use Illuminate\Http\Request;
use Admin\Models\{
    Admin
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Admin::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
