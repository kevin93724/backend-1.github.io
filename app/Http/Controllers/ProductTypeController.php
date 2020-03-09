<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductTypes;

class ProductTypeController extends Controller
{
    public function index() {

        return view ('admin/productType/index');
    }
    public function create() {

        return view ('admin/productType/create');
    }
    public function store(Request $request) {
        $types=$request->all();
        $product_types = ProductTypes::create($types);
        $product_types->save();

        return redirect ('/home/productType');
    }

}
