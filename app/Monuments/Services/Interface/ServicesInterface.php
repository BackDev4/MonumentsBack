<?php

namespace App\Monuments\Services\Interface;

use App\Monuments\Services\DTOs\ServicesDTO;

interface ServicesInterface
{

    public function index();

    public function create(ServicesDTO $DTO);

    public function show($id);

    public function update(ServicesDTO $DTO,$id);

    public function delete($id);


}
