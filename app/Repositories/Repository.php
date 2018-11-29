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
public function get(){

    $builder=$this->model->select('*');


    return $builder->get();
}

}