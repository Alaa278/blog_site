<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "slug" => $this->slug,
            "title"=> $this->title,
            "description" => $this->description,
            "image_path" => $this->image_path,
            "user"=>[
                "id" => $this->user->id,
                "name" => $this->user->name,
                "role_name" => $this->user->role_name,
            ],
            "comments"=>[
                 $this->comments,
                
            ],
            "created_by"=> $this->created_by,
            "updated_by" => $this->updated_by,
            "created_at" => $this->created_at,
            "updated_at" =>$this->updated_at
        ];
    }
}
