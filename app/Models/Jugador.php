<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipo;

class Jugador extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function equipo() {
        // return Equipo::where('id', $this->id_equipo)->first();
        return $this->hasOne('App\Models\Equipo','id','id_equipo');
    }
}
