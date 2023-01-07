<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Platforms;

class PlatformsController extends Controller
{
    public function getGamesPlatforms($slug)
    {
        $platform = Platforms::where('slug', $slug)->first();

        $games = $platform->games()->where('games_platforms.platforms_id', $platform->id)->get();

        return view('gamesplatforms', compact('games', 'platform'));
    }
}
