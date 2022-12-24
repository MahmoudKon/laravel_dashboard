<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Email>
 */
class EmailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'subject'     => $this->faker->text(100),
            'body'        => $this->faker->text(400),
            'to'          => User::inRandomOrder()->take(rand(1,3))->pluck('email')->implode(','),
            'cc'          => User::inRandomOrder()->take(rand(1,3))->pluck('email')->implode(','),
            'notifier_id' => User::first()->id
        ];
    }
}
