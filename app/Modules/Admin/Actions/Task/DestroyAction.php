<?php
namespace Admin\Actions\Task;;
use Illuminate\Http\Request;

use Admin\Models\{
    Task
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Task::withTrashed()->where('id', '!=', auth('admin')->user()->id)->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
