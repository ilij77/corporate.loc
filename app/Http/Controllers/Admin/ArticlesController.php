<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Article;
use Corp\Category;
use Corp\Http\Requests\ArticleRequest;
use Corp\Repositories\ArticlesRepository;
use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArticlesController extends AdminController
{
    public function __construct(ArticlesRepository$a_rep)
    {parent::__construct();
    $this->template=env('THEME').'.admin.articles';
    $this->a_rep=$a_rep;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->user=Auth::user();
        //dd($this->user);
        if ($au= Gate::denies('VIEW_ADMIN_ARTICLES')){
            abort(403);
        };

        $this->title='Менеджер статей';

        $articles=$this->getArticles();
        //dd($articles);

        $this->content=view(env('THEME').'.admin.articles_content')->with('articles',$articles)->render();

        return $this->renderOutput();


    }


    public function getArticles()
    {
       return$this->a_rep->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->user=Auth::user();
        //dd($this->user);
        if ($au= Gate::denies('save',new\Corp\Article)){
            abort(403);
        };
        $this->title='Добавить новый материал';

        $categories=Category::select(['title','alias','parent_id','id'])->get();
      //dd($categories);

        $lists=array();
        foreach($categories as $category) {
        if($category->parent_id == 0) {
            $lists[$category->title] = array();
        }
        else {
            $lists[$categories->where('id',$category->parent_id)->first()->title][$category->id] = $category->title;
        }
    }



        //dd($lists);

        $this->content=view(env('THEME').'.admin.articles_create_content')->with('categories',$lists)->render();
        return $this->renderOutput();


    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
       //dd($request);
        $result=$this->a_rep->addArticle($request);
        if (is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        dd($result);
       return redirect('/admin')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
       //$article=Article::where('alias',$articles);
       //dd($article);

        if (Gate::denies('edit',new Article)){
            abort(403);
        }
        $article->img=json_decode($article->img);

        $categories=Category::select(['title','alias','parent_id','id'])->get();
        //dd($categories);

        $lists=array();
        foreach($categories as $category) {
            if($category->parent_id == 0) {
                $lists[$category->title] = array();
            }
            else {
                $lists[$categories->where('id',$category->parent_id)->first()->title][$category->id] = $category->title;
            }}
            //dd($article);
            $this->title='Редактирование материала - '.$article->title;
            $this->content=view(env('THEME').'.admin.articles_create_content')->with(['categories'=>$lists,'article'=>$article])->render();
            return $this->renderOutput();



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request,Article $article)
    {
        //dd($request);

        $result=$this->a_rep->updateArticle($request,$article);
        if (is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        //dd($result);
        return redirect('/admin')->with($result);



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $result=$this->a_rep->deleteArticle($article);
        if (is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        //dd($result);
        return redirect('/admin')->with($result);

    }
}
