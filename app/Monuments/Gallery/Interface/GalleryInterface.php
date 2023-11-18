<?php

namespace App\Monuments\Gallery\Interface;

use App\Monuments\Gallery\DTOs\GalleryDTO;

interface GalleryInterface
{

    public function index();

    public function create(GalleryDTO $DTO);

    public function show($id);

    public function update(GalleryDTO $DTO, $id);

    public function delete($id);

}
