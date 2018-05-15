<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplysSellers extends Model
{
    //
   protected $table = 'applys_sellers';

   protected $fillable = [
      'id',
      'promoter_id',
      'name_c', 
      'contact_s',
      'phone_s',
      'email',
      'status',
      'assing_at',
      'created_at',
      'updated_at',
      'token',
      'expires_at'
    ];

    public function Promoter()
    {
        return $this->belongsTo('App\Promoters','promoter_id');
    }

}
