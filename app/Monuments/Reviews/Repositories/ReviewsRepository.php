<?php

namespace App\Monuments\Reviews\Repositories;

use App\Monuments\Reviews\DTOs\ReviewsDTO;
use App\Monuments\Reviews\Interface\ReviewsInterface;
use App\Monuments\Reviews\Models\Reviews;

class ReviewsRepository implements ReviewsInterface
{

    public function index()
    {
        return Reviews::paginate(9);
    }

    public function create(ReviewsDTO $DTO)
    {
        $reviews = new Reviews();
        $reviews->fill([
            'name' => $DTO->name,
            'content' => $DTO->content,
        ]);
    }

    public function update(ReviewsDTO $DTO, $id)
    {
        $reviews = Reviews::findOrFail($id);
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
