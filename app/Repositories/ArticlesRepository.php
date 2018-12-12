<?php
/**
 * Created by PhpStorm.
 * User: Илья
 * Date: 29.11.2018
 * Time: 2:03
 */
namespace  Corp\Repositories;
use Corp\Article;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Intervention\Image;
use Symfony\Component\Translation\Tests\IdentityTranslatorTest;

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

    public function addArticle($request)
            {
                if (Gate::denies('save',$this->model)){
                    abort(403);
                }
                $data=$request->except('_token','image');
                if (empty($data)){
                    return array('error'=>'Нет данных');
                }
                if (empty($data['alias'])){
                    $data['alias']=$this->transliterate($data['title']);
                }
                //dd($data);
                if ($this->one($data['alias'],false)){
                    $request->merge(array('alias'=>$data['alias']));
                    //dd($request);
                    $request->flash();
                    return ['error'=>'Данный псевдоним уже используется'];
                }
                if ($request->hasFile('image')){
                    $image=$request->file('image');
                    if ($image->isValid()){
                        $str=str_random(8);

                        $obj=new \stdClass;
                        $obj->mini=$str.'_mini.jpg';
                        $obj->max=$str.'_max.jpg';
                        $obj->path=$str.'.jpg';
                        $img=Image\Facades\Image::make($image);
                        //dd($img);
                        $img->fit(Config::get('settings.image')['wight'],
                            Config::get('settings.image')['height'])->save(public_path().'/'.env('THEME').'/images/articles/'.$obj->path);

                        $img->fit(Config::get('settings.articles_img')['max']['wight'],
                            Config::get('settings.articles_img')['max']['height'])->save(public_path().'/'.env('THEME').'/images/articles/'.$obj->max);

                        $img->fit(Config::get('settings.articles_img')['mini']['wight'],
                            Config::get('settings.articles_img')['mini']['height'])->save(public_path().'/'.env('THEME').'/images/articles/'.$obj->mini);
                        //dd('Hello');

                        $data['img']=json_encode($obj);
                        $this->model->fill($data);
                        if ($request->user()->article()->save($this->model)){
                            return ['status'=>'Материал добавлен'];
                        }

                    }
        }

    }



    public function updateArticle($request,$article)
    {
        if (Gate::denies('edit',$this->model)){
            abort(403);
        }
        $data=$request->except('_token','image','_method');
        if (empty($data)){
            return array('error'=>'Нет данных');
        }
        if (empty($data['alias'])){
            $data['alias']=$this->transliterate($data['title']);
        }
        //dd($data);

        $result=$this->one($data['alias'],false);
        if (isset($result->id) && ($result->id !==$article->id) ){
            $request->merge(array('alias'=>$data['alias']));
            //dd($request);
            $request->flash();
            return ['error'=>'Данный псевдоним уже используется'];
        }
        if ($request->hasFile('image')){
            $image=$request->file('image');
            if ($image->isValid()){
                $str=str_random(8);

                $obj=new \stdClass;
                $obj->mini=$str.'_mini.jpg';
                $obj->max=$str.'_max.jpg';
                $obj->path=$str.'.jpg';
                $img=Image\Facades\Image::make($image);
                //dd($img);
                $img->fit(Config::get('settings.image')['wight'],
                    Config::get('settings.image')['height'])->save(public_path().'/'.env('THEME').'/images/articles/'.$obj->path);

                $img->fit(Config::get('settings.articles_img')['max']['wight'],
                    Config::get('settings.articles_img')['max']['height'])->save(public_path().'/'.env('THEME').'/images/articles/'.$obj->max);

                $img->fit(Config::get('settings.articles_img')['mini']['wight'],
                    Config::get('settings.articles_img')['mini']['height'])->save(public_path().'/'.env('THEME').'/images/articles/'.$obj->mini);
                //dd('Hello');

                $data['img']=json_encode($obj);

                }
                $article->fill($data);
                if ($article->update()){
                   // dd($article);
                    return ['status'=>'Материал обновлен'];
            }
        }

    }

    public function deleteArticle($article)
    {
        if (Gate::denies('destroy',$article)){
            abort(403);
        }
        $article->comment()->delete();
        if ($article->delete()){
            return ['status'=>'Материал удален'];
        }

    }


}