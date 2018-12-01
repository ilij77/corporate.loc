<?php
/**
 * Created by PhpStorm.
 * User: Илья
 * Date: 29.11.2018
 * Time: 2:03
 */
namespace  Corp\Repositories;
use Corp\Articles;

class ArticlesRepository extends Repository
{

    public function __construct(Articles$articles)
    {
        $this->model=$articles;
    }


}