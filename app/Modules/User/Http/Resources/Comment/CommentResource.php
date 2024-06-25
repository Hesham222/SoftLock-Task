<?php

namespace User\Http\Resources\Comment;
use Illuminate\Http\Resources\Json\JsonResource;
use User\Http\Resources\Broker\BrokerResource;
use User\Http\Resources\Developer\DeveloperResource;
use User\Http\Resources\Individual\IndividualResource;
use User\Http\Resources\UserResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
            return [
                'id'                        => intval($this->id),
                'post_id'                   => $this->post_id,
                'user'                      => new UserResource($this->post->user),
                'createdDate'               => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
            ];


    }
}
