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
    public function edit($id) {
        // $news_data = $request -> first();
        // $news = News::find($id);  //單筆
        $product_types = ProductTypes::find($id);
        return view ('admin/productType/edit', compact('product_types'));
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

        // $request_data = $request->all();

        // $item = ProductTypes::find($id);

        // $item->update($request_data);
        // $item->save();
        ProductTypes::find($id)->update($request->all());
        return redirect('/home/productType');



    }

}
