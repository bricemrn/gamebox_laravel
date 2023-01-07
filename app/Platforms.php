<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platforms extends Model
{
    public $timestamps = false;

    public function games()
    {
        return $this->belongsToMany('App\Games', 'games_platforms', 'platforms_id');
    }
}
