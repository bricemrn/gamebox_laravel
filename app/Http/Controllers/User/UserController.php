<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\FavoritesGames;
use Auth;

class UserController extends Controller
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

    public function getProfile()
    {
        $user = Auth::user();

        return view('user.profile', compact('user'));
    }

    public function updateAvatar(Request $request)
    {
        $user = Auth::user();
        $avatar = $request->avatarFile;

        if ($request->file('avatarFile')){
            $fileName = $request->file('avatarFile')->getClientOriginalName();
            $path = 'public/assets/images/user/avatars';
            $request->file('avatarFile')->move($path, $fileName);
        }

        if($avatar){
            $user->avatar = 'assets/images/user/avatars/' . $fileName;
        } else {
            $user->avatar = $user->avatar;
        }
        $user->save();

        return response()->json(['data' => $user->avatar]);
    }

    public function updateName(Request $request)
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->save();

        return response()->json(['data' => $user->name]);
    }

    public function updateEmail(Request $request)
    {
        $user = Auth::user();

        $user->email = $request->email;
        $user->save();

        return response()->json(['data' => $user->email]);
    }    
    
    public function updateBio(Request $request)
    {
        $user = Auth::user();

        $user->my_desc = $request->bio;
        $user->save();

        return response()->json(['data' => $user->my_desc]);
    }

    public function deleteFavoriteGame(Request $request)
    {
        $id = $request->id;
        $user = Auth::user();

        $favoriteGame = FavoritesGames::where('games_id', $id)->where('users_id', $user->id);
        $favoriteGame->delete();

        return redirect()->back()->with('success', 'Le jeu a bien été retiré de vos favoris.');
    }
}