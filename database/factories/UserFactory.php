<?php

namespace Database\Factories;

use App\Models\Aggregator;
use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        DB::select("DELETE FROM `users` WHERE `id` > 1");
        return [
            'name'                  => $this->faker->name(),
            'email'                 => $this->faker->unique()->safeEmail(),
            'behalf_id'             => User::inRandomOrder()->first()->id,
            'password'              => 123,
            'aggregator_id'         => Aggregator::inRandomOrder()->first()->id,
            'department_id'         => Department::inRandomOrder()->first()->id,
            'annual_credit'         => $this->faker->numberBetween(10, 100),
            'finger_print_id'       => $this->faker->unique()->numberBetween(2, 5000),
            'salary_per_monthly'    => $this->faker->numberBetween(1000, 10000),
            'insurance_deduction'   => $this->faker->numberBetween(100, 1000),
            'email_verified_at'     => now(),
            'remember_token'        => Str::random(10),
            'image'                => $this->faker->imageUrl(300, 300, 'cats'),
        ];
    }



    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    // public function unverified()
    // {
    //     return $this->state(function (array $attributes) {
    //         return [
    //             'email_verified_at' => null,
    //         ];
    //     });
    // }
}
