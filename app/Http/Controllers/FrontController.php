<?php

namespace App\Http\Controllers;


use App\News;
use DB;  //連結資料庫
use App\Products;
use App\ContactUs;
use App\Mail\SendToUser;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

    public function products()
    {
        $products_data = Products::orderBy('sort', 'desc')->get();
        return view('front/products', compact('products_data'));
    }

    public function products_detail($productId)
    {
        $Product = Products::find($productId);
        return view('front/products_detail', compact('Product'));
    }

    


    //
    public function cart() {

        return view ('front/cart');
    }

    //

    public function cart_total() {
        return view ('front/cart_total');
    }
    //
    public function contactUs() {
        return view ('front/contactUs');
    }
    //

    public function contactUs_store(Request $request){
        $user_data = $request -> all();
        $content = ContactUs::create($user_data);
        Mail::to('kevin0114@gmail.com')->send(new OrderShipped($content)); //寄信

        return redirect('/contactUs');


    }


}
