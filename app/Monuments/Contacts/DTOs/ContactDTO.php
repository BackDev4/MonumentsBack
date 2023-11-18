<?php

namespace App\Monuments\Contacts\DTOs;

class ContactDTO
{
    public string $phone;

    public function __construct(
        string $phone
    )
    {
        $this->phone = $phone;
    }
}
