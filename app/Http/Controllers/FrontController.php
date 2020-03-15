<?php

namespace App\Http\Controllers;

use DB;  //連結資料庫
use App\News;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class FrontController extends Controller
{
    public function index() {
        return view ('front/index');
    }
    public function news() {
        $news_data = DB::table('news')->orderBy('sort','desc')->get();
        // $news_data = News::orderBy('sort','desc')->get();
        return view ('front/news', compact('news_data'));
    }
    public function news_detail($id) {
        // $item = News::find($id);
        //         return view ('front/news_detail', compact('item'));
            $news = News::with('news_imgs')->find($id);
            return view ('front/news_detail', compact('news'));



    }
    //
    public function cart() {

        return view ('front/cart');
    }

    //

    public function cart_total() {
        return view ('front/cart_total');

    }
}
