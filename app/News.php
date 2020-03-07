<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table ="news" ;
    protected $fillable = [
        'image', 'title','content', 'sort'
    ];

    public function news_imgs()
    {
        return $this->hasMany('App\news_imgs', 'news_id','id')->orderby('sort','desc');
    }



    //
}
