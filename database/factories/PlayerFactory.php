<?php

namespace Database\Factories;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'team_id' => $this->faker->numberBetween(Team::all()->first()->id, Team::all()->last()->id),
            'position' => $this->faker->randomElement(Player::positions())
        ];
    }
}
