<?php
namespace App\Actions\File;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
class RemoveFileAction
{
    public function execute(Request $request): void
    {
       FileTrait::RemoveFile($request->input('resource_id'));
    }
}
