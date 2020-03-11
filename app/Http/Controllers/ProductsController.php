<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\ProductTypes;
use App\Products;
use App\ProductsImgs;

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
    // public function products()
    // {
    //     return view('admin/products');
    // }
    public function index()
    {
        $all_products = Products::all();
        return view('admin/products/index',compact('all_products'));
    }
    public function create()
    {
        $type = ProductTypes::all();
        return view('admin/products/create',compact('type'));
    }
    //
    public function store(Request $request){
        $products_data = $request -> all();

        if($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $this->fileUpload($file,'products');
            $products_data['image'] = $path;
        }

        //多張上傳
        $products_new = Products::create($products_data);

        if($request->hasFile('products_imgs')) {  //news_img 來自create.blade.php name="news_img[]"
            $files = $request->file('products_imgs');

            foreach ($files as $file) {
                //上傳圖片
                $path = $this->fileUpload($file,'products');

                //建立Newe多張圖檔
                $products_imgs = new ProductsImgs;
                $products_imgs->products_id = $products_new->id;
                $products_imgs->img_url = $path;
                $products_imgs->save();
            }
        }

        // Products::create($products_data)->save();
        return redirect('home/products/');
    }
    //
    public function edit($id) {
        // $news_data = $request -> first();
        $type = ProductTypes::all();
        $products = Products::find($id);

        return view('admin/products/edit',compact('type','products'));
    }
    //
    public function update(Request $request,$id){

        //法一
        // $news = News::find($id);
        // $news->img = $request->img;
        // $news->title = $request->title;
        // $news->content = $request->content;
        // $news->save();

        //法二
            // Products::find($id)->update($request->all());
            $request_data = $request->all();
            $item = Products::find($id);

        //if有上傳新圖片
        if($request->hasFile('img')){
            //舊圖片刪除
            $old_image = $item->img;
            File::delete(public_path().$old_image);

            //上傳新圖片
            $file = $request->file('img');
            $path = $this->fileUpload($file,'products');
            $request_data['img'] = $path;
        }

        //增加多張圖片上傳
        if($request->hasFile('products_imgs')) {  //news_img 來自create.blade.php name="news_img[]"
            $files = $request->file('products_imgs');

            foreach ($files as $file) {
                //上傳圖片
                $path = $this->fileUpload($file,'products');

                //建立Newe多張圖檔
                $products_imgs = new ProductsImgs;
                $products_imgs->products_id = $item->id;   //DB裏的news id
                $products_imgs->img_url = $path;
                $products_imgs->save();
            }

        }

        $item->update($request_data);

        return redirect('home/products/');
    }
    //
    public function delete(Request $request,$id) {

        $item = Products::find($id);
        $old_image = $item->img;
        if(file_exists(public_path().$old_image)){
            File::delete(public_path().$old_image);
        }

        $item->delete();

        //多張圖片刪除
        $products_imgs = ProductsImgs::where('products_id','=', $id) ->get();

        foreach ($products_imgs as $products_img) {
            $old_image = $products_img->img_url;

            if(file_exists(public_path().$old_image)){
                File::delete(public_path().$old_image);
            }
            $products_img->delete();
        }
        // Products::find($id)->delete();
        return redirect('home/products/');
    }
    //
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


    public function ajax_delete_products_imgs(Request $request) {
        $productsimgid = $request->products_imgid;

        $item = ProductsImgs::find($productsimgid);   //多張圖方法(model:NewsImgs)中的id

        $old_image = $item->img_url;
        if(file_exists(public_path().$old_image)){
            File::delete(public_path().$old_image);
        }

        $item->delete();

        // return $newsimgid;
        return 'ajax success:'.$productsimgid;
    }

    public function ajax_product_post_sort(Request $request) {
        $products_img_id = $request->img_id;
        $sort = $request->sort_value;

        $img = ProductsImgs::find($products_img_id);
        $img->sort = $sort;
        $img->save();
        return "成功";
    }


}


