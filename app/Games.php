<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    public function categories()
    {
        return $this->belongsToMany('App\Categories', 'games_categories', 'games_id');
    }

    public function platforms()
    {
        return $this->belongsToMany('App\Platforms', 'games_platforms', 'games_id');
    }

    public function news()
    {
        return $this->belongsToMany('App\News', 'news_games_categories', 'games_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'games_categories', 'games_id');
    }
}