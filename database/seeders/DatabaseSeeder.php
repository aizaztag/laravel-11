<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Note;
use App\Models\Package;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create(
            [
                'id' => 1,
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('123123')
            ]
        );

        //Note::factory(100)->create();

        Feature::create(
            [
                'image' => 'image',
                'route_name' => 'feature1.index',
                'name' => 'Calculate Sum',
                'description' => 'Calculate Sum of two numbers',
                'required_credits' => 1,
                'active' => true
            ]
        );

        Feature::create(
            [
                'image' => 'image',
                'route_name' => 'feature2.index',
                'name' => 'Calculate Sum',
                'description' => 'Calculate Sum of two numbers',
                'required_credits' => 3,
                'active' => true
            ]
        );

        Package::create(
            [
                'name' => 'Basic',
                'price' => 5,
                'credits' => 20,
            ]
        );

        Package::create(
            [
                'name' => 'Silver',
                'price' => 20,
                'credits' => 100,
            ]
        );

        Package::create(
            [
                'name' => 'Gold',
                'price' => 50,
                'credits' => 500,
            ]
        );
    }
}
