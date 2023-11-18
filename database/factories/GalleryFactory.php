<?php

namespace Database\Factories;

use App\Monuments\Gallery\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GalleryFactory extends Factory
{

    protected $model = Gallery::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->title,
            'image' => $this->faker->imageUrl,
        ];
    }
}
