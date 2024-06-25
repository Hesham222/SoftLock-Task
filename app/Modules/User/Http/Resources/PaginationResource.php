<?php

namespace User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaginationResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'size'       => $this->perPage(),
            'total'      => $this->total(),
            'current'    => $this->currentPage(),
            'first'      => $this->url(1),
            'last'       => $this->url($this->lastPage()),
            'prev'       => $this->previousPageUrl(),
            'next'       => $this->nextPageUrl(),
            'totalPages' => $this->lastPage(),
        ];
    }
}
