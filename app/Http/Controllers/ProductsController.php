<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProductTypes;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function products()
    {
        return view('front/products');
    }
    public function index()
    {
        return view('front/products');
    }
}

