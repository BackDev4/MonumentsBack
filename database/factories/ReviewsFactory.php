<?php

namespace Database\Factories;

use App\Monuments\Reviews\Models\Reviews;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewsFactory extends Factory
{
    protected $model = Reviews::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'content' => $this->faker->text(255),
        ];
    }
}
