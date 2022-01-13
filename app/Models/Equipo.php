<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jugador;

class Equipo extends Model
{
    use HasFactory;

    public function jugador() {
        // $jugador = Jugador::find($this->equipo_id);
        return $this->belongsTo('App\Models\Jugador');
    }

}
