<?php

namespace Database\Factories;

use App\Monuments\Contacts\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ContactsFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->name,
            'data' => $this->faker->phoneNumber,
        ];
    }
}
