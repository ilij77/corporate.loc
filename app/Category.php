<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   public function article(){
      return $this->hasMany('Corp\Articles');
   }
}
