<?php

namespace App\Monuments\Reviews\Interface;

use App\Monuments\Reviews\DTOs\ReviewsDTO;

interface ReviewsInterface
{
    public function index();
    public function create(ReviewsDTO $DTO);
    public function update(ReviewsDTO $DTO, $id);
    public function delete($id);
}
