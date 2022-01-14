<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::create([ 'name' => 'Athletic Club', 'stadium' => 'Estadio San Mamés' ]);
        Team::create([ 'name' => 'Atlético de Madrid', 'stadium' => 'Wanda Metropolitano' ]);
        Team::create([ 'name' => 'CA Osasuna', 'stadium' => 'Estadio El Sadar' ]);
        Team::create([ 'name' => 'Cádiz CF', 'stadium' => 'Estadio Nuevo Mirandilla' ]);
        Team::create([ 'name' => 'Deportivo Alavés', 'stadium' => 'Mendizorroza' ]);
        Team::create([ 'name' => 'Elche CF', 'stadium' => 'Estadio Martínez Valero' ]);
        Team::create([ 'name' => 'FC Barcelona', 'stadium' => 'Camp Nou' ]);
        Team::create([ 'name' => 'Getafe CF', 'stadium' => 'Coliseum Alfonso Pérez' ]);
        Team::create([ 'name' => 'Granada CF', 'stadium' => 'Nuevo Los Cármenes' ]);
        Team::create([ 'name' => 'Levante UD', 'stadium' => 'Estadio Ciutat de València' ]);
        Team::create([ 'name' => 'Rayo Vallecano', 'stadium' => 'Estadio de Vallecas' ]);
        Team::create([ 'name' => 'RC Celta', 'stadium' => 'Estadio ABANCA Balaídos' ]);
        Team::create([ 'name' => 'RCD Espanyol de Barcelona', 'stadium' => 'RCDE Stadium' ]);
        Team::create([ 'name' => 'RCD Mallorca', 'stadium' => 'Visit Mallorca Estadi' ]);
        Team::create([ 'name' => 'Real Betis', 'stadium' => 'Estadio Benito Villamarín' ]);
        Team::create([ 'name' => 'Real Madrid', 'stadium' => 'Estadio Santiago Bernabéu' ]);
        Team::create([ 'name' => 'Real Sociedad', 'stadium' => 'Reale Arena' ]);
        Team::create([ 'name' => 'Sevilla FC', 'stadium' => 'Ramón Sánchez-Pizjuán' ]);
        Team::create([ 'name' => 'Valencia CF', 'stadium' => 'Camp de Mestalla' ]);
        Team::create([ 'name' => 'Villarreal CF', 'stadium' => 'Estadio de la Cerámica' ]);                
    }
}
