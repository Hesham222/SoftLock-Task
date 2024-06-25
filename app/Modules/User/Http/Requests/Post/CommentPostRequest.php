<?php

namespace User\Http\Requests\Post;
use User\Http\Requests\BaseRequest;

class CommentPostRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'post_id'                   =>'required|integer|exists:posts,id',
            'comment'                   => 'required|string|min:3|max:99999',



        ];
    }

}
