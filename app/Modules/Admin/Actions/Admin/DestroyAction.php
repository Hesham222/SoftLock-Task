<?php
namespace Admin\Actions\Admin;;
use Illuminate\Http\Request;

use Admin\Models\{
    Admin
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Admin::withTrashed()->where('id', '!=', auth('admin')->user()->id)->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
