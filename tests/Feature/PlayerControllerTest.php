<?php

namespace Tests\Feature;

use App\Models\Player;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlayerControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */


    public function test_user_can_index()
    {
        $response = $this->get('/player');

        $response->assertStatus(200);
    }

    public function test_user_can_edit()
    {
        $faker = Factory::create();
        $id = $faker->numberBetween(Player::all()->first()->id, Player::all()->last()->id);

        $response = $this->get("/player/$id/edit", [
            'id' => $id,
        ]);

        $response->assertStatus(200);
    }

    public function test_user_can_store()
    {
        $player = Player::factory()->create();

        $response = $this->post('/player/store', [
            'name' => $player->name,
            'team_id' => $player->team_id,
            'position' => $player->position
        ]);

        $response->assertStatus(302);
    }

    public function test_user_can_update()
    {
        $player = Player::factory()->create();
        $faker = Factory::create();

        $response = $this->put('/player/update', [
            'id' => $faker->numberBetween(Player::all()->first()->id, Player::all()->last()->id),
            'name' => $player->name,
            'team_id' => $player->team_id,
            'position' => $player->position
        ]);

        $response->assertStatus(302);
    }
    
    public function test_user_can_destroy()
    {
        $faker = Factory::create();
        $id = $faker->numberBetween(Player::all()->first()->id, Player::all()->last()->id);
        $response = $this->delete("/player/$id", [
            'id' => $id,
        ]);

        $response->assertStatus(200);
    }    

}
