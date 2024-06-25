<?php
namespace User\Actions\Post;

use App\Modules\Admin\Models\Posts\PostFavourite;
use Illuminate\Http\Request;

class SavePostAction
{
    public function execute(Request $request,$user)
    {
        $record = PostFavourite::create([
            'post_id'=> $request->input('post_Id'),
            'individual_id'=> $user->id,
        ]);
        return $record;
    }
}
