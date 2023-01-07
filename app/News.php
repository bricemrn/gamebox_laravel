<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public function games()
    {
        return $this->belongsToMany('App\Games', 'news_games_categories', 'news_id', 'games_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Categories', 'news_games_categories', 'news_id', 'categories_id');
    }
}
