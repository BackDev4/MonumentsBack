<?php

namespace App\Monuments\Reviews\Controllers;

use App\Http\Controllers\Controller;
use App\Monuments\Reviews\DTOs\ReviewsDTO;
use App\Monuments\Reviews\Repositories\ReviewsRepository;

class ReviewsController extends Controller
{

    private ReviewsRepository $repository;

    public function __construct(ReviewsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function create(ReviewsDTO $DTO)
    {
        $this->repository->create($DTO);
    }
}
