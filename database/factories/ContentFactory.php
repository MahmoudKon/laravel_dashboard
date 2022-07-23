<?php

namespace Database\Factories;

use App\Constants\ContentType;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Content>
 */
class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'             => ['en' => $this->faker->sentence(6), 'ar' => $this->faker->sentence(6)],
            'data'              => ['en' => $this->faker->text(), 'ar' => $this->faker->text()],
            'content_type_id'   => ContentType::NORMAL_TEXT,
            'category_id'       => Category::inRandomOrder()->first()->id,
        ];
    }
}
