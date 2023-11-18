<?php

namespace App\Monuments\Gallery\DTOs;

class GalleryDTO
{
    public string $title;
    public string $image;

    public function __construct(
        string $title,
        string $image
    )
    {
        $this->title = $title;
        $this->image = $image;
    }
}
