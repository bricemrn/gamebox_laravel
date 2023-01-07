<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\News;
use App\Games;
use App\Categories;
use App\NewsGamesCategories;

class AdminNewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function getNews()
    {
        $news = News::orderBy('created_at', 'desc')->get();

        $games = Games::all();

        $categories = Categories::all();

        return view('admin.admin_news', compact('news', 'games', 'categories'));
    }

    public function addNews(Request $request)
    {
        $validator = $request->validate([
            'imageAdd' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'game' => 'required|digits_between:1,9',
            'category' => 'required|digits_between:1,9',
            'title' => 'required|max:255',
            'desc_intro_highlight' => 'required',
            'desc_intro' => 'required',
            'desc_body' => 'required',
            'author' => 'required|max:255',
            'slug' => 'required|max:255'
        ]);

        if ($request->file('imageAdd')){
            $fileName = $request->file('imageAdd')->getClientOriginalName();
            $path = base_path() . '/public/assets/images/news';
            $request->file('imageAdd')->move($path, $fileName);
        }

        $news = new News;
        if($request->imageAdd) {
            $news->image = 'assets/images/news/' . $fileName;
        } else {
            $news->image = $news->image;
        }
        $news->news_title = $request->title;
        $news->desc_intro_highlight = $request->desc_intro_highlight;
        $news->desc_intro = $request->desc_intro;
        $news->desc_body = $request->desc_body;
        $news->author = $request->author;
        $news->slug = $request->slug;
        $news->highlighted = 0;
        $news->save();

        $newsGameCategory = new NewsGamesCategories;
        $newsGameCategory->news_id = News::where('news_title', $request->title)->first()->id;
        $newsGameCategory->games_id = $request->game;
        $newsGameCategory->categories_id = $request->category;
        $newsGameCategory->save();

        return redirect()->back();
    }

    public function updateNews(Request $request)
    {
        $id = $request->updateId;

        if ($request->file('imageUpdate')){
            $fileName = $request->file('imageUpdate')->getClientOriginalName();
            $path = 'public/assets/images/news';
            $request->file('imageUpdate')->move($path, $fileName);
        }

        $news = News::find($id);
        if($request->imageUpdate) {
            $news->image = 'assets/images/news/' . $fileName;
        } else {
            $news->image = $news->image;
        }
        $news->news_title = $request->title;
        $news->desc_intro_highlight = $request->desc_intro_highlight;
        $news->desc_intro = $request->desc_intro;
        $news->desc_body = $request->desc_body;
        $news->author = $request->author;
        $news->slug = $request->slug;
        $news->highlighted = $news->highlighted;
        $news->save();

        $newsGameCategory = NewsGamesCategories::where('news_id', $id)->first();
        $newsGameCategory->news_id = $id;
        $newsGameCategory->games_id = $request->game;
        $newsGameCategory->categories_id = $request->category;
        $newsGameCategory->save();

        return redirect()->back();
    }

    public function deleteNews(Request $request)
    {
        $id = $request->deleteId;

        $news = News::where('id', $id);
        $news->delete();

        $newsGameCategory = NewsGamesCategories::where('id', $id);
        $newsGameCategory->delete();

        return redirect()->back();
    }
}
