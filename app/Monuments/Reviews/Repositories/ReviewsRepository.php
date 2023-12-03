<?php

namespace App\Monuments\Reviews\Repositories;

use App\Monuments\Reviews\DTOs\ReviewsDTO;
use App\Monuments\Reviews\Interface\ReviewsInterface;
use App\Monuments\Reviews\Models\Reviews;
use Mockery\Exception;

class ReviewsRepository implements ReviewsInterface
{

    public function index()
    {
        return Reviews::paginate(9);
    }

    public function store(ReviewsDTO $DTO)
    {
        $reviews = new Reviews();
        $reviews->fill([
            'name' => $DTO->name,
            'content' => $DTO->content,
        ]);
        $reviews->save();
    }

    public function update(ReviewsDTO $DTO, $id)
    {
        $reviews = Reviews::where('id', request('id'))->first();
        $reviews->fill([
            'name' => $DTO->name,
            'content' => $DTO->content,
        ]);
        $reviews->save();
    }

    public function delete($id)
    {
        return Reviews::destroy($id);
    }
}
