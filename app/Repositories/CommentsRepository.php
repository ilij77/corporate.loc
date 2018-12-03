<?php
/**
 * Created by PhpStorm.
 * User: Илья
 * Date: 29.11.2018
 * Time: 2:03
 */
namespace  Corp\Repositories;
use Corp\Comment;

class CommentsRepository extends Repository
{

    public function __construct(Comment$comment)
    {
        $this->model=$comment;
    }


}