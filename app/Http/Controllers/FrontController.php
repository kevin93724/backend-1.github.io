<?php

namespace App\Http\Controllers;


use App\News;
use DB;  //連結資料庫
use App\Products;
use App\ContactUs;
use App\Mail\SendToUser;
use App\Mail\OrderShipped;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // $products_data = Products::orderBy('sort', 'desc')->get();
        // return view('front/products', compact('products_data'));
        $products = Products::all();

        return view('front/products',compact('products'));


    }

    public function products_detail($productId)
    {
        // $Product = Products::find($productId);
        // return view('front/products_detail', compact('Product'));
        $Product = Products::find($productId);
        return view('front/products_detail',compact('Product'));

    }




    //
    // public function cart() {

    //     return view ('front/cart');
    // }

    //

    // public function cart_total() {
    //     return view ('front/cart_total');
    // }
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

    //
        //購物車

        public function add_cart($productId)
        {
            // $productId=1;
            $Product = Products::find($productId); // assuming you have a Product model with id, name, description & price
            $rowId = $productId; // generate a unique() row ID

            // add the product to cart
            \Cart::add(array(
                'id' => $rowId,
                'name' => $Product->title,
                'price' => $Product->price,
                'quantity' => 1,
                'attributes' => array(),
                'associatedModel' => $Product
            ));
            // dd($Product);
            return redirect('cart');
        }

        public function update_cart(Request $request,$product_id)
        {
            $quantity = $request->quantity;
            // return $quantity;

            \Cart::update($product_id, array(
                'quantity' => $quantity, // so if the current product has a quantity of 4, it will subtract 1 and will result to 3
              ));

            return 'success';
        }

        public function delete_cart(Request $request,$product_id)
        {
            Cart::remove($product_id);

            return 'success';
        }


        public function cart_total(){
            // $userID = Auth::user()->id;
            // $items = \Cart::session($userID)->getContent();
            // dd($items);
            $items = \Cart::getContent()->sort();

            return view('front.cart', compact('items'));



        }

        // public function cart_total()
        // {
        //     $items = \Cart::getContent()->sort();
        //     // $items = Cart::getContent()->sort();

        //     return view('front.cart', compact('items'));
        //     // return view('front.cart');
        // }
        public function test_products_detail(){
            return view('front.test_products_detail');
        }




}
