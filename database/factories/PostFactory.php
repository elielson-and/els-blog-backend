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
            "slug" => Str::slug($title, '-'),
            "description" => $this->faker->text(255),
            "content" => $this->faker->paragraphs(20, true),
            "user_id" => 2, //User::factory(),
            "created_at" => $this->faker->dateTime,
            "updated_at" => $this->faker->dateTime,
        ];
    }
}
