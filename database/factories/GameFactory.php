<?php

namespace Database\Factories;

use App\Models\Edition;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'edition_id' => $this->faker->numberBetween(Edition::all()->first()->id, Edition::all()->last()->id),
            'match_day' => $this->faker->numberBetween(1,Team::count() * 2),
            'team_local_id' => $this->faker->numberBetween(Team::all()->first()->id, Team::all()->last()->id),
            'team_visitor_id' => $this->faker->numberBetween(Team::all()->first()->id, Team::all()->last()->id),
            'goals_local' => $this->faker->numberBetween(0, 5),
            'goals_visitor' => $this->faker->numberBetween(0, 5)
        ];
    }
}
