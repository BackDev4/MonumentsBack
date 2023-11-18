<?php

namespace App\Monuments\Gallery\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class GalleryResource
{

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image' => $this->image,
        ];
    }


}
