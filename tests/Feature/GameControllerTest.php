<?php

namespace Tests\Feature;

use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Faker\Factory;
use Tests\TestCase;

class GameControllerTest extends TestCase
{
    public function test_user_can_index_game()
    {
        $response = $this->get(route('game.index'));  

        $response->assertStatus(200);
    }

    public function test_user_can_edit_game()
    {
        $faker = Factory::create();
        $id = $faker->numberBetween(Game::all()->first()->id, Game::all()->last()->id);
        
        $response = $this->get(route('game.edit', [
            'game' => $id,
        ]));

        $response->assertStatus(200);
    }

    public function test_user_can_store_game()
    {
        $game = Game::factory()->make();

        $response = $this->post(route('game.store', [
            'game' => $game->id,
            'edition_id' => $game->edition_id,
            'match_day' => $game->match_day,
            'team_local_id' => $game->team_local_id,
            'team_visitor_id' => $game->team_visitor_id,
            'goals_local' => $game->goals_local,
            'goals_visitor' => $game->goals_visitor,
        ]));        

        $response->assertStatus(200);
    }

    public function test_user_cannot_store_game_without_edition()
    {
        $game = Game::factory()->make();

        $response = $this->post(route('game.store', [
            'game' => $game->id,
            'edition_id' => null,
            'match_day' => $game->match_day,
            'team_local_id' => $game->team_local_id,
            'team_visitor_id' => $game->team_visitor_id,
            'goals_local' => $game->goals_local,
            'goals_visitor' => $game->goals_visitor,
        ]));        

        $response->assertStatus(302);
    } 

    public function test_user_can_update_game()
    {
        $game = Game::factory()->make();
        $faker = Factory::create();
        $id = $faker->numberBetween(Game::all()->first()->id, Game::all()->last()->id);

        $response = $this->patch(route('game.update', [
            'game' => $id,
            'id' => $id,
            'edition_id' => $game->edition_id,
            'match_day' => $game->match_day,
            'team_local_id' => $game->team_local_id,
            'team_visitor_id' => $game->team_visitor_id,
            'goals_local' => $game->goals_local,
            'goals_visitor' => $game->goals_visitor
        ]));

        $response->assertStatus(200);
    }
    
    public function test_user_can_destroy_game()
    {
        $faker = Factory::create();
        $id = $faker->numberBetween(Game::all()->first()->id, Game::all()->last()->id);

        $response = $this->delete(route('game.destroy', [
            'game' => $id,
            'id' => $id,
        ]));

        $response->assertStatus(200);
    }
}
