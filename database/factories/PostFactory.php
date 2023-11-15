<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
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
        $title = $this->faker->sentence(5);
        return [
            "title" => $title,
            "slug" => Str::slug($title, '-'), // Gera o slug com base no título
            "description" => $this->faker->text(255),
            "content" => "Content", //$this->faker->paragraphs(3, true), // Gera um conteúdo
            "user_id" => 2, //User::factory(), // Usa uma factory para o User
            "created_at" => $this->faker->dateTime,
            "updated_at" => $this->faker->dateTime,
        ];
    }
}
