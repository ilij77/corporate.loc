<?php
/**
 * Created by PhpStorm.
 * User: Илья
 * Date: 29.11.2018
 * Time: 2:03
 */
namespace  Corp\Repositories;
use Corp\Article;

class ArticlesRepository extends Repository
{

    public function __construct(Article$articles)
    {
        $this->model=$articles;
    }

    public function one($alias,$attr=array()){
        $article=parent::one($alias,$attr);

        if ($article && !empty($attr)){
           $article->load('comment');
           $article->comment->load('user');
        }
        return $article;
    }


}