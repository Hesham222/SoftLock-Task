<?php
namespace User\Actions\Comment;

use User\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;

class DestroyAction
{
    public function execute(Request $request,$user)
    {

        $record        = Comment::find($request->input('postId'));

        if ($record->post_id == $user->id){
            if(!$record)
                return false;
            $record->forceDelete();
            return $request->input('postId');
        }
    }
}
