<?php
/**
 * Created by PhpStorm.
 * User: Илья
 * Date: 29.11.2018
 * Time: 2:03
 */
namespace  Corp\Repositories;
use Corp\Slider;

class SlidersRepository extends Repository
{

    public function __construct(Slider $slider)
    {
        $this->model=$slider;
    }


}