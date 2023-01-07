<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\NewsGamesCategories;
use App\Comments;
use Auth;

class NewsController extends Controller
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

    public function getNews()
    {
        $lastNews = News::select('*')->orderBy('created_at', 'desc')->limit(4)->get();

        $news = News::select('*')->orderBy('created_at', 'desc')->get();

        $newsHighlighted = News::where('highlighted', '=', '1')->orderBy('created_at', 'desc')->get();

        return view('news', compact('lastNews', 'news', 'newsHighlighted'));
    }

    public function getNewsDetails($slug)   
    {
        $news = News::where('slug', $slug)->first();

        foreach($news->games as $game){
            $gameId = $game->id;
        }

        $otherNews = NewsGamesCategories::
              join('news', 'news.id', 'news_games_categories.news_id')
            ->where('news_games_categories.games_id', '=', $gameId)
            ->where('news.id', '!=', $news->id)
            ->get();

        $comments = Comments::
              join('users', 'users.id', 'comments.users_id')
            ->where('news_id', $news->id)
            ->select('users.name', 'users.avatar', 'comments.id', 'comments.users_id', 'comments.comments_body', 'comments.created_at', 'comments.updated_at')
            ->orderBy('comments.created_at', 'desc')
            ->paginate(10);

        return view('newsdetails', compact('news', 'otherNews', 'comments'));
    }

    public function addComments(Request $request, $id)
    {
        $validator = $request->validate([
            'comment' => 'required'
        ]);

        $newComment = new Comments;
        $newComment->comments_body = $request->comment;
        $newComment->news_id = $id;
        $newComment->users_id = Auth::user()->id;
        $newComment->save();

        return redirect()->back()->with('success', 'Votre commentaire a bien été publié.');
    }

    public function deleteComments(Request $request)
    {   
        $commentId = $request->commentId;

        $comment = Comments::where('id', $commentId);
        $comment->delete();

        return redirect()->back()->with('success', 'Votre commentaire a bien été supprimé.');
    }
}