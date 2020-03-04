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

        //上傳檔案
        $file_name = $request->file('image')->store('','public');
        $news_data['image'] = $file_name;

        News::create($news_data)->save();
        return redirect ('/home/news');
    }
    public function edit($id) {
        $news = News::find($id);
        return view ('admin/news/edit', compact('news'));
    }
    public function update(Request $request, $id) {


        News::find($id)->update($request->all());
        return redirect ('/home/news');
    }
    public function delete(Request $request, $id) {

        // console.log($id);
        News::find($id)->delete();
        return redirect ('/home/news');
        // dd($id);
    }

    //
}
