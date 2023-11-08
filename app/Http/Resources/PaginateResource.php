<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginateResource extends JsonResource
{
    public function __construct($status, $message, $resource, $paginate)
    {
        parent::__construct($resource);
        $this->status  = $status;
        $this->message = $message;
        $this->paginate = $paginate;
    }

    /**
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    */
    public function toArray($request)
    {
        return [
            'success'   => $this->status,
            'message'   => $this->message,
            'data'      => $this->resource,
            'pagination'=> [
                'current_page' => $this->paginate->currentPage(),
                'has_more_page' => $this->paginate->hasMorePages(),
                'total_pages' => $this->paginate->lastPage(),
                'per_page' => $this->paginate->perPage(),
                'total_items' => $this->paginate->total(),
            ]
        ];
    }
}
