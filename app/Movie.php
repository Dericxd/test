<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';

    protected $fillable = [
        'id', 'seller_id','title',
        'original_title', 'img_poster',
        'story', 'country', 'based_on',
        'duration','after', 'before',
        'saga_id', 'release_year',
        'rating_id', 'cost','status',
        'trailer_url'
    ];
}
