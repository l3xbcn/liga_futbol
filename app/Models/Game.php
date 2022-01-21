<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function team_local() {
        return $this->hasOne('App\Models\Team','id','team_local_id');
        // return $this->belongsTo(Team::class);
    }
    public function team_visitor() {
        return $this->hasOne('App\Models\Team','id','team_visitor_id');
        // return $this->belongsTo(Team::class);
    }

}
