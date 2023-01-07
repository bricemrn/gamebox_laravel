<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\News;

class AdminNewsHighlightsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getNews()
    {
        $news = News::orderBy('created_at', 'desc')->get();

        return view('admin.admin_news_highlights', compact('news'));
    }

    public function addNewsHighlights(Request $request)
    {
        $highlighted = $request->highlighted;

        foreach($highlighted as $key => $value){
            News::where('id', $key)->update(['highlighted' => $value]);
        }

        return redirect()->back();
    }
}