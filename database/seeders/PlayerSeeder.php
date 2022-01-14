<?php

namespace Database\Seeders;

use App\Models\Player;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Player::create([ 'name' => 'Xavi Hernández', 'team_id' => 7, 'position' => 'entrenador' ]);
        Player::create([ 'name' => 'Ter Stegen', 'team_id' => 7, 'position' => 'portero' ]);
        Player::create([ 'name' => 'Sergiño Dest', 'team_id' => 7, 'position' => 'defensa' ]);
        Player::create([ 'name' => 'Gerard Piqué', 'team_id' => 7, 'position' => 'defensa' ]);
        Player::create([ 'name' => 'Jordi Alba', 'team_id' => 7, 'position' => 'defensa' ]);
        Player::create([ 'name' => 'Samuel Umtiti', 'team_id' => 7, 'position' => 'defensa' ]);
        Player::create([ 'name' => 'Sergio Busquets', 'team_id' => 7, 'position' => 'centrocampista' ]);
        Player::create([ 'name' => 'Philippe Coutinho Correia', 'team_id' => 7, 'position' => 'centrocampista' ]);
        Player::create([ 'name' => 'Pedro González López \'Pedri\'', 'team_id' => 7, 'position' => 'centrocampista' ]);
        Player::create([ 'name' => 'Frenkie de Jong', 'team_id' => 7, 'position' => 'centrocampista' ]);
        Player::create([ 'name' => 'Ricard \'Riqui\' Puig Martí', 'team_id' => 7, 'position' => 'delantero' ]);
        Player::create([ 'name' => 'Ousmane Dembélé', 'team_id' => 7, 'position' => 'delantero' ]);
        Player::create([ 'name' => 'Memphis Depay', 'team_id' => 7, 'position' => 'delantero' ]);
        Player::create([ 'name' => 'Anssumane \'Ansu\' Fati Vieira', 'team_id' => 7, 'position' => 'delantero' ]);
        Player::create([ 'name' => 'Carlo Ancelotti', 'team_id' => 16, 'position' => 'entrenador' ]);
        Player::create([ 'name' => 'Thibaut Courtois', 'team_id' => 16, 'position' => 'portero' ]);
        Player::create([ 'name' => 'Daniel Carvajal', 'team_id' => 16, 'position' => 'defensa' ]);
        Player::create([ 'name' => 'Éder Gabriel Militão', 'team_id' => 16, 'position' => 'defensa' ]);
        Player::create([ 'name' => 'David Alaba', 'team_id' => 16, 'position' => 'defensa' ]);
        Player::create([ 'name' => 'Marcelo Vieira Da Silva Junior', 'team_id' => 16, 'position' => 'defensa' ]);
        Player::create([ 'name' => 'Toni Kroos', 'team_id' => 16, 'position' => 'centrocampista' ]);
        Player::create([ 'name' => 'Luka Modric', 'team_id' => 16, 'position' => 'centrocampista' ]);
        Player::create([ 'name' => 'Dani Ceballos', 'team_id' => 16, 'position' => 'centrocampista' ]);
        Player::create([ 'name' => 'Francisco \'Isco\' Román Alarcón Suárez', 'team_id' => 16, 'position' => 'centrocampista' ]);
        Player::create([ 'name' => 'Eden Hazard', 'team_id' => 16, 'position' => 'delantero' ]);
        Player::create([ 'name' => 'Karim Benzema', 'team_id' => 16, 'position' => 'delantero' ]);
        Player::create([ 'name' => 'Luka Jovic', 'team_id' => 16, 'position' => 'delantero' ]);
        Player::create([ 'name' => 'Gareth Bale', 'team_id' => 16, 'position' => 'delantero' ]);
    }
}
