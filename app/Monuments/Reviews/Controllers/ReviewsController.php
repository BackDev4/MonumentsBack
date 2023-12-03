<?php

namespace App\Monuments\Reviews\Controllers;

use App\Http\Controllers\Controller;
use App\Monuments\Reviews\DTOs\ReviewsDTO;
use App\Monuments\Reviews\Repositories\ReviewsRepository;
use App\Monuments\Reviews\Requests\ReviewsRequest;

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

    public function store(ReviewsRequest $request)
    {
        try {
            $DTO = $request->toDto();
            $this->repository->store($DTO);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
