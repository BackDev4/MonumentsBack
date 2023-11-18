<?php

namespace App\Monuments\Services\DTOs;

class ServicesDTO
{

    public string $title;
    public string $content;
    public string $image;

    public function __construct(
        string $title,
        string $content,
        string $image,
    )
    {
        $this->title = $title;
        $this->content = $content;
        $this->image = $image;
    }
}
