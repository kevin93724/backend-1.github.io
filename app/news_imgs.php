<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $news_id
 * @property string $image_url
 * @property int $sore
 * @property string $created_at
 * @property string $updated_at
 */
class news_imgs extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $table = 'news_imgs';
    protected $fillable = ['news_id', 'image_url', 'sort', 'created_at', 'updated_at'];

}
