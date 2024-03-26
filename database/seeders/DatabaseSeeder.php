<?php

namespace Database\Seeders;

use App\Models\Type;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Type::create(['name' => 'education']);
        Type::create(['name' => 'informatique']);
        Type::create(['name' => 'marketing']);
        Type::create(['name' => 'Enseignement']);
        Type::create(['name' => 'Service']);
    }
}