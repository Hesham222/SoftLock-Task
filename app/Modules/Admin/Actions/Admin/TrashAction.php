<?php
namespace Admin\Actions\Admin;
use Illuminate\Http\Request;
use Admin\Models\{
    Admin
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Admin::where('id', '!=', 1)->where('id', '!=', auth('admin')->user()->id)->find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
