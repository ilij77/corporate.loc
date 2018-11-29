<?php
/**
 * Created by PhpStorm.
 * User: Илья
 * Date: 29.11.2018
 * Time: 2:03
 */
namespace  Corp\Repositories;
use Corp\Menu;

class MenusRepository extends Repository
{

    public function __construct(Menu$menu)
    {
        $this->model=$menu;
    }


}