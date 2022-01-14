<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;

class Player extends Model
{
    use HasFactory;
    public $timestamps = false;
    public static function positions() {
        return ['entrenador','portero','defensa','centrocampista','delantero'];
    }

    public function team() {
        // return $this->hasOne('App\Models\Team','id','team_id');
        return $this->belongsTo(Team::class);
    }
}
