<?php

namespace App\Monuments\Reviews\DTOs;

class ReviewsDTO
{

    public string $name;
    public string $content;

    public function __construct(
        $name,
        $content,
    )
    {
        $this->name = $name;
        $this->content = $content;
    }
}
