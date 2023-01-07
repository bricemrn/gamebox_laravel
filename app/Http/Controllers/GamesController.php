<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Games;
use App\NewsGamesCategories;
use App\FavoritesGames;
use Auth;

class GamesController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getGames()
    {
        $games = Games::orderBy('created_at', 'desc')->paginate(12);

        return view('games', compact('games'));
    }

    public function getGamesDetails($slug)
    {
        $game = Games::where('slug', $slug)->first();

        $gameNews = NewsGamesCategories::
              join('news', 'news.id', 'news_games_categories.news_id')
            ->where('news_games_categories.games_id', '=', $game->id)
            ->get();

        return view('gamesdetails', compact('game', 'gameNews'));
    }

    public function pagination(Request $request)
    {
        $games = Games::orderBy('created_at', 'desc')->paginate(12);

        return view('gamesresults', compact('games'));
    }

    public function search(Request $request)
    {
        $games = Games::where('games_title', 'like', '%'.$request->search.'%')->paginate(12);

        return view('gamesresults', compact('games'));
    }

    public function addFavoriteGame(Request $request)
    {
        $id = $request->id;
        $user = Auth::user();

        $hasFavoriteGame = $user->games()->where('games_id', $id)->exists();

        if($hasFavoriteGame){
            return redirect()->back()->with('error', 'Attention ! Ce jeu est déjà dans vos favoris.');
        } else {
            $favoriteGame = new FavoritesGames;
            $favoriteGame->games_id = $id;
            $favoriteGame->users_id = $user->id;
            $favoriteGame->save();
            
            return redirect()->back()->with('success', 'Le jeu a bien été ajouté à vos favoris.');
        }
    }
}