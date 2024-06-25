<?php
namespace User\Actions\Post;

use User\Models\Post;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;

class DestroyAction
{
    public function execute(Request $request,$user)
    {

        $record        = Post::find($request->input('postId'));

        if ($record->user_id == $user->id){
            if(!$record)
                return false;
            $record->forceDelete();
            return $request->input('postId');
        }
    }
}
