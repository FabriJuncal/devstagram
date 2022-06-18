<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'titulo' => $this->faker->sentence(5), // Genera una frase de 5 palabras
            'descripcion' => $this->faker->sentence(20), // Genera una frase de 20 palabras
            'imagen' => $this->faker->uuid() . '.jpg', // Genera un UUID y le agrega .jpg
            'user_id' => $this->faker->randomElement([1, 2, 3]) // Genera un numero aleatorio entre 1 y 3
        ];
    }
}
