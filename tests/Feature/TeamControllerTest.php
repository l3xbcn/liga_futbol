<?php

namespace Tests\Feature;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory;

class TeamControllerTest extends TestCase
{
    public function test_user_can_index_team()
    {
        $response = $this->get(route('team.index'));  

        $response->assertStatus(200);
    }

    public function test_user_can_edit_team()
    {
        $faker = Factory::create();
        $id = $faker->numberBetween(Team::all()->first()->id, Team::all()->last()->id);
        
        $response = $this->get(route('team.edit', [
            'team' => $id,
        ]));

        $response->assertStatus(200);
    }

    public function test_user_can_store_team()
    {
        $team = Team::factory()->make();

        $response = $this->post(route('team.store', [
            'player' => $team->id,
            'name' => $team->name,
            'stadium' => $team->stadium,
        ]));        

        $response->assertStatus(200);
    }

    public function test_user_cannot_store_team_without_name()
    {
        $team = Team::factory()->make();

        $response = $this->post(route('team.store', [
            'player' => $team->id,
            'name' => null,
            'stadium' => $team->stadium,
        ]));        

        $response->assertStatus(302);
    }    

    public function test_user_can_update_team()
    {
        $team = Team::factory()->make();
        $faker = Factory::create();
        $id = $faker->numberBetween(Team::all()->first()->id, Team::all()->last()->id);

        $response = $this->put(route('team.update', [
            'team' => $id,
            'id' => $id,
            'name' => $team->name,
            'stadium' => $team->stadium,
        ]));

        $response->assertStatus(200);
    }
    
    public function test_user_can_destroy_team()
    {
        $faker = Factory::create();
        $id = $faker->numberBetween(Team::all()->first()->id, Team::all()->last()->id);

        $response = $this->delete(route('team.destroy', [
            'team' => $id,
            'id' => $id
        ]));

        $response->assertStatus(200);
    }
}
