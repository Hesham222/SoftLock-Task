<?php
namespace User\Actions\Comment;

use User\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;

class StoreAction
{
    public function execute(Request $request,$user)
    {

        $record = Comment::create([
            'post_id'             => $request->input('post_id'),
            'comment'         => $request->input('comment'),

        ]);

        return $record;
    }
}
