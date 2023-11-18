<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\ContactsFactory;
use Database\Factories\GalleryFactory;
use Database\Factories\ReviewsFactory;
use Database\Factories\ServicesFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(1)->create();
        ReviewsFactory::new()->count(10)->create();
        ServicesFactory::new()->count(10)->create();
        GalleryFactory::new()->count(10)->create();
        ContactsFactory::new()->count(3)->create();
    }
}
