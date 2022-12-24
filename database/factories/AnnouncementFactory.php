<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'      => $this->faker->sentence(),
            'desc'       => $this->faker->text(),
            'start_date' => now()->subDays( rand(0,3) ),
            'end_date'   => now()->addDays( rand(0,3) ),
            'url'        => $this->faker->url(),
            'open_type'  => rand(0,1),
            'active'     => rand(0,1)
        ];
    }
}
