<?php

namespace User\Http\Requests\Post;
use User\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'postId'                    =>'required|exists:posts,id',
            'description'               => 'required|string|min:3|max:255',
            'title'                     => 'required|string|min:3|max:255',
        ];
    }

}
