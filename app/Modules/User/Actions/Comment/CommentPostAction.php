<?php
namespace User\Actions\Comment;

use User\Models\Comment;
use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;

class CommentPostAction
{
    public function execute(Request $request,$user)
    {

        $record = Comment::create([
            'post_id'                   => $request->input('post_id'),
            'description'               => $request->input('description'),

        ]);

        return $record;
    }
}
