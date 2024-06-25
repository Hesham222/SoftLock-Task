<?php
namespace App\Actions\File;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
class UploadFilesAction
{
    public function execute(Request $request, $path, $model): void
    {
       FileTrait::storeMultipleFiles($request->file('files'), $path, $model, $request->input('resource_id'));
    }
}
