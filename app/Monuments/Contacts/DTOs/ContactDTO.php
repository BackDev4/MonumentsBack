<?php

namespace App\Monuments\Contacts\DTOs;

class ContactDTO
{
    public string $type;
    public string $data;

    public function __construct(
        string $type,
        string $data
    )
    {
        $this->type = $type;
        $this->data = $data;
    }
}
