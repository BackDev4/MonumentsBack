<?php

namespace App\Monuments\Reviews\DTOs;

class ReviewsDTO
{

    public string $name;
    public string $content;

    public function __construct(
        string $name,
        string $content
    )
    {
        $this->name = $name;
        $this->content = $content;
    }
}
