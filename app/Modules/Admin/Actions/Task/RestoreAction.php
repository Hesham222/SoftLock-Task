<?php
namespace Admin\Actions\Task;;
use Illuminate\Http\Request;
use Admin\Models\{
    Task
};

class RestoreAction
{
    public function execute(Request $request)
    {
        $record = Task::onlyTrashed()->find($request->resource_id);
        $record->deleted_by = null;
        $record->save();
        $record->restore();
        return $record->id;
    }
}
