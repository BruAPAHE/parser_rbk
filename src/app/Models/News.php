<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class News extends Model
{

    /**
     * @var string
     */
    protected $collection = "news";

    protected $fillable = [
        'title',
        'link',
        'description',
    ];

}
