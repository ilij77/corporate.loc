<?php

namespace Corp\Http\Controllers;

use Corp\Category;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\CommentsRepository;
use Corp\Repositories\PortfoliosRepository;
use Illuminate\Http\Request;

class ArticlesController extends SiteController
{
    public function __construct(PortfoliosRepository$p_rep,ArticlesRepository $a_rep,CommentsRepository $c_rep)
    {
        parent::__construct(new\Corp\Repositories\MenusRepository(new \Corp\Menu));
        $this->template=env('THEME').'.articles';
        $this->bar='right';
        $this->p_rep=$p_rep;
        $this->a_rep=$a_rep;
        $this->c_rep=$c_rep;
    }

    public function index($cat_alias=false)
    {
        $articles=$this->getArticles($cat_alias);

  //dd($articles);

        $content=view(env('THEME').'.articles_content')->with('articles',$articles)->render();
        $this->vars=array_add($this->vars,'content',$content);

        $comments=$this->getComments(config('settings.resent_comments'));
        $portfolios=$this->getPortfolios(config('settings.resent_portfolios'));

       // dd($comments);
       //dd($portfolios);

        $this->contentRightBar=view(env('THEME').'.articlesBar')->with(['comments'=>$comments,'portfolios'=>$portfolios]);

        return $this->renderOutput();
    }

    public function getComments($take){

        $comments=$this->c_rep->get(['text','name','email','site','article_id','user_id'],$take);
        if ($comments) {
            $comments->load('article', 'user');
        }

        return $comments;
    }

    public function getportfolios($take){

        $portfolios=$this->p_rep->get(['title','text','alias','customer','img','filter_alias'],$take);
        return $portfolios;
    }



    public function getArticles($alias=false){

        $where=false;

        if ($alias){

            //WHERE 'alias'=$alias
            $id=Category::select('id')->where('alias',$alias)->first();
            //dd($id);
            $where=['category_id',$id];
            //dd($where);
        }
     $articles=$this->a_rep->get(['id','title','alias','created_at','img','desc','user_id','category_id','keywords','meta_desc'],false,true,$where);

    if ($articles){
        $articles->load('user','category','comment');
    }
    return$articles;
    }

 public function show($alias=false){

     $this->template=env('THEME').'.articles';

        $article=$this->a_rep->one($alias,['comments'=>true]);
        if ($article){
            $article->img=json_decode($article->img);
        }
       // dd($article->comment->groupBy('parent_id'));

     //dd($article->user->name);
     //dd($article->title);

     if (isset($article->id)){
         $this->title=$article->title;
         $this->keywords=$article->keywords;
         $this->meta_desc=$article->meta_desc;
     }



        $content=view(env('THEME').'.article_content')->with('article',$article)->render();
        $this->vars=array_add($this->vars,'content',$content);

     $comments=$this->getComments(config('settings.resent_comments'));
     $portfolios=$this->getPortfolios(config('settings.resent_portfolios'));
     $this->contentRightBar=view(env('THEME').'.articlesBar')->with(['comments'=>$comments,'portfolios'=>$portfolios]);

        return$this->renderOutput();
 }

}
