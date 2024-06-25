<?php

namespace User\Http\Requests\Post;
use User\Http\Requests\BaseRequest;

class RemoveRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'postId'=>'required|exists:posts,id',
        ];
    }

}
