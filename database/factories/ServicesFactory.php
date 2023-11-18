<?php

namespace Database\Factories;

use App\Monuments\Services\Models\Services;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ServicesFactory extends Factory
{
    protected $model = Services::class;

    public function definition(): array
    {

        return [
            'title' => $this->faker->name(),
            'content' => $this->faker->text(255),
            'image' => $this->faker->imageUrl(),
        ];
    }
}
