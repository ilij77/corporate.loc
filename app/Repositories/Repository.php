<?php
/**
 * Created by PhpStorm.
 * User: Илья
 * Date: 29.11.2018
 * Time: 2:07
 */

namespace Corp\Repositories;
use Config;

abstract class Repository
{
protected $model=false;
public function get($select='*',$take=false){

    $builder=$this->model->select($select);
if ($take){
    $builder->take($take);
}

    return $builder->get();
}

}