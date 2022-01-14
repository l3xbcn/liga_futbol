<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Game::create([ 'edition_id' => 91, 'match_day' => 1, 'team_local_id' => 19, 'team_visitor_id' => 8, 'goals_local' => 1, 'goals_visitor' => 0 ]);
        Game::create([ 'edition_id' => 91, 'match_day' => 1, 'team_local_id' => 14, 'team_visitor_id' => 15, 'goals_local' => 1, 'goals_visitor' => 1 ]);
        Game::create([ 'edition_id' => 91, 'match_day' => 1, 'team_local_id' => 4, 'team_visitor_id' => 10, 'goals_local' => 1, 'goals_visitor' => 1 ]);
        Game::create([ 'edition_id' => 91, 'match_day' => 1, 'team_local_id' => 5, 'team_visitor_id' => 16, 'goals_local' => 1, 'goals_visitor' => 4 ]);
        Game::create([ 'edition_id' => 91, 'match_day' => 1, 'team_local_id' => 3, 'team_visitor_id' => 13, 'goals_local' => 0, 'goals_visitor' => 0 ]);
        Game::create([ 'edition_id' => 91, 'match_day' => 1, 'team_local_id' => 12, 'team_visitor_id' => 2, 'goals_local' => 1, 'goals_visitor' => 2 ]);
        Game::create([ 'edition_id' => 91, 'match_day' => 1, 'team_local_id' => 7, 'team_visitor_id' => 17, 'goals_local' => 4, 'goals_visitor' => 2 ]);
        Game::create([ 'edition_id' => 91, 'match_day' => 1, 'team_local_id' => 18, 'team_visitor_id' => 11, 'goals_local' => 3, 'goals_visitor' => 0 ]);
        Game::create([ 'edition_id' => 91, 'match_day' => 1, 'team_local_id' => 20, 'team_visitor_id' => 9, 'goals_local' => 0, 'goals_visitor' => 0 ]);
        Game::create([ 'edition_id' => 91, 'match_day' => 1, 'team_local_id' => 6, 'team_visitor_id' => 1, 'goals_local' => 0, 'goals_visitor' => 0 ]);
        Game::create([ 'edition_id' => 91, 'match_day' => 2, 'team_local_id' => 15, 'team_visitor_id' => 4, 'goals_local' => 1, 'goals_visitor' => 1 ]);
        Game::create([ 'edition_id' => 91, 'match_day' => 2, 'team_local_id' => 5, 'team_visitor_id' => 14, 'goals_local' => 0, 'goals_visitor' => 1 ]);
        Game::create([ 'edition_id' => 91, 'match_day' => 2, 'team_local_id' => 9, 'team_visitor_id' => 19, 'goals_local' => 1, 'goals_visitor' => 1 ]);
        Game::create([ 'edition_id' => 91, 'match_day' => 2, 'team_local_id' => 13, 'team_visitor_id' => 20, 'goals_local' => 0, 'goals_visitor' => 0 ]);
        Game::create([ 'edition_id' => 91, 'match_day' => 2, 'team_local_id' => 1, 'team_visitor_id' => 7, 'goals_local' => 1, 'goals_visitor' => 1 ]);
        Game::create([ 'edition_id' => 91, 'match_day' => 2, 'team_local_id' => 17, 'team_visitor_id' => 11, 'goals_local' => 1, 'goals_visitor' => 0 ]);
        Game::create([ 'edition_id' => 91, 'match_day' => 2, 'team_local_id' => 2, 'team_visitor_id' => 6, 'goals_local' => 1, 'goals_visitor' => 0 ]);
        Game::create([ 'edition_id' => 91, 'match_day' => 2, 'team_local_id' => 10, 'team_visitor_id' => 16, 'goals_local' => 3, 'goals_visitor' => 3 ]);
        Game::create([ 'edition_id' => 91, 'match_day' => 2, 'team_local_id' => 8, 'team_visitor_id' => 18, 'goals_local' => 0, 'goals_visitor' => 1 ]);
        Game::create([ 'edition_id' => 91, 'match_day' => 2, 'team_local_id' => 3, 'team_visitor_id' => 12, 'goals_local' => 0, 'goals_visitor' => 0 ]);
                
    }
}
