<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
class NewsController extends Controller
{
    public function index() {
        $all_news = News::all();
        return view ('admin/news/index' , compact('all_news'));
    }
    public function create() {
        return view ('admin/news/create');
    }
    public function store(Request $request) {
        $news_data=$request ->all();
        News::create($news_data) ->save();
        return redirect ('/home/news');
    }
    public function edit($id) {
        $news = News::find($id);
        return view ('admin/news/edit', compact('news'));
    }
    public function update(Request $request, $id) {

        $news_data=$request ->all();
        News::create($news_data) ->save();
        return redirect ('/home/news');
    }

    //
}
