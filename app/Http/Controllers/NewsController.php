<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\News;
use App\news_imgs;
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
        $news_data=$request->all();
        // dd($news_data);

        //上傳主要圖片
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $this->fileUpload($file,'news');
            $news_data['image'] = $path;
        }

        $new_news = News::create($news_data);


        //Create多張圖片
        if ($request->hasFile('news_imgs')) {  //news_img 來自create.blade.php name="news_img[]"
            $files = $request->file('news_imgs');

            foreach ($files as $file) {
                //上傳圖片
                $path = $this->fileUpload($file,'news');

                //建立News多張圖片的資料
                $news_imgs = new news_imgs;
                $news_imgs->news_id = $new_news->id;
                $news_imgs->image_url = $path;
                $news_imgs->save();
            }
        }

        return redirect ('/home/news');
    }

    public function edit($id) {
        // $news_data = $request -> first();
        // $news = News::find($id);  //單筆
        $news = News::with("news_imgs")->find($id);
        return view ('admin/news/edit', compact('news'));
    }

    public function update(Request $request, $id) {

        //法一
        // $news = News::find($id);
        // $news->img = $request->img;
        // $news->title = $request->title;
        // $news->content = $request->content;
        // $news->save();

        //法二
        // News::find($id)->update($request->all());

        $request_data = $request->all();

        $item = News::find($id);

        //if有上傳新圖片
        if($request->hasFile('image')){
            //舊圖片刪除
            $old_image = $item->image;
            File::delete(public_path().$old_image);

            //上傳新圖片
            $file = $request->file('image');
            $path = $this->fileUpload($file,'news');
            $request_data['image'] = $path;
        }

        //增加多張圖片上傳
        if($request->hasFile('news_imgs')) {  //news_img 來自create.blade.php name="news_img[]"
            $files = $request->file('news_imgs');

            foreach ($files as $file) {
                //上傳圖片
                $path = $this->fileUpload($file,'news');

                
                //建立Newe多張圖檔
                $news_imgs = new news_imgs;
                $news_imgs->news_id = $item->id;   //DB裏的news id
                $news_imgs->image_url = $path;
                $news_imgs->save();
            }

        }


        $item->update($request_data);

        return redirect('/home/news');


        // News::find($id)->update($request->all());
        // return redirect ('/home/news');
    }

    public function delete(Request $request, $id) {

        // console.log($id);
        $item = News::find($id);

        $old_image = $item->image;
        if(file_exists(public_path().$old_image)){
            File::delete(public_path().$old_image);
        }

        $item->delete();

        //多圖片刪除
        $news_imgs_1 = news_imgs::where('news_id','=' ,$id)->get();
        foreach ($news_imgs_1 as $news_img) {
            $old_image = $news_img->image_url;
            if(file_exists(public_path().$old_image)){
                File::delete(public_path().$old_image);
            }
            $news_img->delete();

        }


        // News::find($id)->delete();
        return redirect ('/home/news');
        // dd($id);
    }

    private function fileUpload($file,$dir){
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if( ! is_dir('upload/')){
            mkdir('upload/');
        }
        //防呆：資料夾不存在時將會自動建立資料夾，避免錯誤
        if ( ! is_dir('upload/'.$dir)) {
            mkdir('upload/'.$dir);
        }
        //取得檔案的副檔名
        $extension = $file->getClientOriginalExtension();
        //檔案名稱會被重新命名
        $filename = strval(time().md5(rand(100, 200))).'.'.$extension;
        //移動到指定路徑
        move_uploaded_file($file, public_path().'/upload/'.$dir.'/'.$filename);
        //回傳 資料庫儲存用的路徑格式
        return '/upload/'.$dir.'/'.$filename;
    }

    //
}
