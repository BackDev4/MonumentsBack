<?php

namespace App\Monuments\Gallery\Controllers;

use App\Http\Controllers\Controller;
use App\Monuments\Gallery\Repositories\GalleryRepository;

class GalleryController extends Controller
{

    private GalleryRepository $repository;

    public function __construct(GalleryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function show($id)
    {
        return $this->repository->show($id);
    }
}
