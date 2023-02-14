<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\User;
use \App\Models\Channel;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommunityLink>
 */
class CommunityLinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'user_id' =>User ::all()->random()->id,
            'channel_id' =>Channel::all()->random()->id,
            'title' => $this->faker->sentence,
            'link' => $this->faker->url,
            'approved' => 0
        ];
    }
}
