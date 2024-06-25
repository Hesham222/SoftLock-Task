<?php

namespace User\Http\Requests\Post;
use User\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{

    public function rules()
    {
        return [

            'description'               => 'required|string|min:3|max:255',
            'title'                      => 'required|string|min:3|max:255',
        ];
    }

}
