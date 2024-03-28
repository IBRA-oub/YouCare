<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use App\Models\Annonce;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Annonce>
 */
class AnnonceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           
           
                // 'titre' => $this->faker->sentence(),
                // 'description' => $this->faker->paragraph(),
                // 'date' => $this->faker->date(),
                // 'location' => $this->faker->city(),
                // 'competance' => $this->faker->text(),
                // 'type_id' => 1,
                // 'user_id' => \App\Models\User::factory(),
            
            
        ];
    }


    public function unverified()
    {
        return $this->state(function (array $attributes) {
            // return [
            //     'email_verified_at' => null,
            // ];
        });
    }
}