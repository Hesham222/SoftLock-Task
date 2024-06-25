<?php
namespace User\Actions\Comment;

use User\Models\Post;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;

class UpdateAction
{
    public function execute(Request $request,$user)
    {

            $record        = Post::find($request->input('postId'));

            $record->description                = $request->input('description');
            $record->title                      = $request->input('title');

            $record->save();



            return $record;

    }
}
