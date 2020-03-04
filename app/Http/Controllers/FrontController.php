<?php

namespace App\Http\Controllers;

use DB;
// use App\News;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index() {
        return view ('front/index');
    }
    public function news() {
        $news_data = DB::table('news')->orderBy('sort','desc')->get();
        return view ('front/news', compact('news_data'));
    }

    //
}
