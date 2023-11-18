<?php

namespace App\Monuments\Contacts\Interface;

use App\Monuments\Contacts\DTOs\ContactDTO;

interface ContactInterface
{

    public function index();

    public function create(ContactDTO $DTO);

    public function show($id);

    public function update(ContactDTO $DTO, $id);

    public function delete($id);

}
