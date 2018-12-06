<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
   public function  user(){
       return $this->belongsTo('Corp\User');
   }

   public function category(){
     return $this-> belongsTo('Corp\Category');
   }

    public function comment(){
       return $this-> hasMany('Corp\Comment');
    }
}
