<?php

namespace User\Http\Resources\Post;

use App\Modules\Admin\Models\Listings\ListingFavourite;
use App\Modules\Admin\Models\Posts\PostFavourite;
use Illuminate\Http\Resources\Json\JsonResource;
use User\Http\Resources\Area\AreaResource;
use User\Http\Resources\City\CityResource;
use User\Http\Resources\Comment\CommentCollection;
use User\Http\Resources\Image\ImageCollection;
use User\Http\Resources\Individual\IndividualResource;
use User\Http\Resources\Post\Completion\CompletionResource;
use User\Http\Resources\Post\Reason\ReasonResource;
use User\Http\Resources\Post\ReasonOption\ReasonOptionResource;
use User\Http\Resources\Post\Sale\SaleResource;
use User\Http\Resources\Post\Status\StatusResource;
use User\Http\Resources\Post\Type\TypeResource;
use User\Http\Resources\UserResource;

class PostResource extends JsonResource
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
            'user'                      => $this->user_id?new UserResource($this->user):null,
            'description'               => $this->description,
            'title'                     => $this->title,
            'createdDate'               => date('d M Y', strtotime($this->created_at)) ." - ". date('h:i a', strtotime($this->created_at)),
            'comments'                  => new CommentCollection($this->comments),

        ];
    }
}
