<?php
namespace User\Actions\Post;

use User\Models\Post;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;

class StoreAction
{
    public function execute(Request $request,$user)
    {

        $record = Post::create([
            'user_id'             => $user->id,
            'description'         => $request->input('description'),
            'title'               => $request->input('title'),

        ]);

        return $record;
    }
}
