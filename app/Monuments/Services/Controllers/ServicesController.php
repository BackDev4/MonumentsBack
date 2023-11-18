<?php

namespace App\Monuments\Services\Controllers;

use App\Monuments\Services\Repositories\ServicesRepository;

class ServicesController
{
    private ServicesRepository $repository;

    public function __construct(ServicesRepository $repository)
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
