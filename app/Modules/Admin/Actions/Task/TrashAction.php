<?php
namespace Admin\Actions\Task;
use Illuminate\Http\Request;
use Admin\Models\{
    Task
};
class TrashAction
{
    public function execute(Request $request)
    {
        $record = Task::find($request->resource_id);
        if(!$record)
            return false;
        $record->deleted_by = auth('admin')->user()->id;
        $record->save();
        $record->delete();
        return $record->id;
    }
}
