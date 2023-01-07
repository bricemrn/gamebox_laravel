<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Games;
use App\Categories;
use App\GamesCategories;

class CategoriesController extends Controller
{
    public function getGamesCategories($slug)
    {
        $category = Categories::where('slug', $slug)->first();

        $games = $category->games()->where('games_categories.categories_id', $category->id)->get();

        return view('gamescategories', compact('games', 'category'));
    }
}
