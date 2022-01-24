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
    public function test_user_can_index_player()
    {
        $response = $this->get(route('player.index'));  

        $response->assertStatus(200);
    }

    public function test_user_can_edit_player()
    {
        $faker = Factory::create();
        $id = $faker->numberBetween(Player::all()->first()->id, Player::all()->last()->id);
        
        $response = $this->get(route('player.edit', [
            'player' => $id,
        ]));

        $response->assertStatus(200);
    }

    public function test_user_can_store_player()
    {
        $player = Player::factory()->make();

        $response = $this->post(route('player.store', [
            'player' => $player->id,
            'name' => $player->name,
            'team_id' => $player->team_id,
            'position' => $player->position
        ]));        

        $response->assertStatus(200);
    }

    public function test_user_cannot_store_player_without_name()
    {
        $player = Player::factory()->make();

        $response = $this->post(route('player.store', [
            'player' => $player->id,
            'name' => null,
            'team_id' => $player->team_id,
            'position' => $player->position
        ]));        

        $response->assertStatus(302);
    }    

    public function test_user_can_update_player()
    {
        $player = Player::factory()->make();
        $faker = Factory::create();
        $id = $faker->numberBetween(Player::all()->first()->id, Player::all()->last()->id);

        $response = $this->patch(route('player.update', [
            'player' => $id,
            'id' => $id,
            'name' => $player->name,
            'team_id' => $player->team_id,
            'position' => $player->position
        ]));

        $response->assertStatus(200);
    }
    
    public function test_user_can_destroy_player()
    {
        $faker = Factory::create();
        $id = $faker->numberBetween(Player::all()->first()->id, Player::all()->last()->id);

        $response = $this->delete(route('player.destroy', [
            'player' => $id,
            'id' => $id,
        ]));

        $response->assertStatus(200);
    }    
}
