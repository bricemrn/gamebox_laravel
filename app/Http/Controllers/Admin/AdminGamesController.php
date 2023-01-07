<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Games;
use App\Categories;
use App\GamesCategories;
use App\Platforms;
use App\GamesPlatforms;

class AdminGamesController extends Controller
{
    /**
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getGames()
    {
        $games = Games::orderBy('created_at', 'desc')->get();

        $categories = Categories::all();

        $platforms = Platforms::all();

        return view('admin.admin_games', compact('games', 'categories', 'platforms'));
    }

    public function addGame(Request $request)
    {
        $validator = $request->validate([
            'posterAdd' => 'required|image|mimes:jpeg,jpg,png,svg,webp|max:2048',
        ]);

        if ($request->file('posterAdd')){
            $fileName = $request->file('posterAdd')->getClientOriginalName();
            $path = base_path() . '/public/assets/images/posters';
            $request->file('posterAdd')->move($path, $fileName);
        }

        $game = new Games;
        $game->poster = 'assets/images/posters/' . $fileName;
        $game->games_title = $request->title;
        $game->desc_intro = $request->desc_intro;
        $game->desc_body = $request->desc_body;
        $game->release_date = $request->release_date;
        $game->slug = $request->slug;
        $game->save();

        foreach($request->category as $category){
            $gameCategory = new GamesCategories;
            $gameCategory->games_id = Games::where('games_title', $request->title)->first()->id;
            $gameCategory->categories_id = $category;
            $gameCategory->save();        
        }
        
        foreach($request->platform as $platform){
            $gamePlatform = new GamesPlatforms;
            $gamePlatform->games_id = Games::where('games_title', $request->title)->first()->id;
            $gamePlatform->platforms_id = $platform;
            $gamePlatform->save();
        }

        return redirect()->back();
    }

    public function updateGame(Request $request)
    {
        $gameId = $request->updateGameId;
        
        if ($request->file('posterUpdate')){
            $fileName = $request->file('posterUpdate')->getClientOriginalName();
            $path = 'public/assets/images/posters';
            $request->file('posterUpdate')->move($path, $fileName);
        }
        
        $game = Games::find($gameId);
        if($request->posterUpdate) {
            $game->poster = 'assets/images/posters/' . $fileName;
        } else {
            $game->poster = $game->poster;
        }
        $game->games_title = $request->title;
        $game->desc_intro = $request->desc_intro;
        $game->desc_body = $request->desc_body;
        $game->release_date = $request->release_date;
        $game->slug = $request->slug;
        $game->save();  

        foreach($request->category as $category){
            $gameCategory = GamesCategories::where('games_id', $gameId)->where('categories_id', $category)->firstOrNew();
            $gameCategory->games_id = $gameId;
            $gameCategory->categories_id = $category;
            $gameCategory->save();
        }

        foreach($request->platform as $platform){
            $gamePlatform = GamesPlatforms::where('games_id', $gameId)->where('platforms_id', $platform)->firstOrNew();
            $gamePlatform->games_id = $gameId;
            $gamePlatform->platforms_id = $platform;
            $gamePlatform->save();
        }
        
        return redirect()->back();
    }

    public function deleteGame(Request $request)
    {
        $gameId = $request->deleteGameId;
    
        $game = Games::where('id', $gameId);
        $game->delete();
        
        $gamesCategories = GamesCategories::where('games_id', $gameId);
        $gamesCategories->delete();        
        
        $gamesPlatforms = GamesPlatforms::where('games_id', $gameId);
        $gamesPlatforms->delete();
    
        return redirect()->back();
    }
}
