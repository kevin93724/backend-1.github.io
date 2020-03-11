<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table ="products" ;
    protected $fillable = [
        'image', 'title','content', 'sort', 'type_id'
    ];
    public function product_type(){
        return $this->belongsTo('App\ProductTypes','type_id','id')->orderby('sort','desc');
    }

    public function products_imgs(){
        return $this->hasMany('App\ProductsImgs','products_id','id')->orderby('sort','desc');
    }
}
