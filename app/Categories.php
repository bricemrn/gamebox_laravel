<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public $timestamps = false;
    
    public function games()
    {
        return $this->belongsToMany('App\Games', 'games_categories', 'categories_id');
    }

    public function news()
    {
        return $this->belongsToMany('App\News', 'news_games_categories', 'categories_id');
    }
}
