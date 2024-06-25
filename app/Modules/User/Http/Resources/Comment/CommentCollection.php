<?php

namespace User\Http\Resources\Comment;
use Illuminate\Http\Resources\Json\ResourceCollection;
class CommentCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
    	$data = [];
    	foreach ($this->collection as $record) {
    		array_push($data, new CommentResource($record));
    	}
    	return $data;
    }
}
