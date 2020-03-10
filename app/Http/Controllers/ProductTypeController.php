<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductTypes;

class ProductTypeController extends Controller
{
    public function index() {
        $items = ProductTypes::all();
        return view ('admin/productType/index', compact('items'));
    }
    public function create() {

        return view ('admin/productType/create');
    }
    public function store(Request $request) {
        $types=$request->all();
        // dd($types);
        $product_types = ProductTypes::create($types);
        $product_types->save();

        return redirect ('/home/productType');
    }

}
