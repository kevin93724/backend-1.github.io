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
        dd($news_data)

        //上傳主要圖片
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $this->fileUpload($file,'news');
            $news_data['image'] = $path;
        }

        $new_news = News::create($news_data);
        //Create多張圖片
        if ($request->hasFile('new_imgs')) {
            foreach ($files as $file) {
                //上傳圖片
                $file_name=
            }


        }




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
