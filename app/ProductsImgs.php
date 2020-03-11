<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsImgs extends Model
{
    protected $table = 'products_imgs';

    protected $keyType = 'integer';
    protected $fillable = ['products_id', 'img_url', 'sort', 'created_at', 'updated_at'];
}
