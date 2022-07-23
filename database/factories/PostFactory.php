<?php

namespace Database\Factories;

use App\Models\Content;
use App\Models\Operator;
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
            'published_date' => $this->faker->dateTimeInInterval('-1 years', $interval = '+ 5 days'),
            'active'         => rand(0, 1),
            'content_id'     => Content::inRandomOrder()->first()->id,
            'operator_id'    => Operator::inRandomOrder()->first()->id,
        ];
    }
}
