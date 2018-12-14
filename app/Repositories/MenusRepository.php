<?php
/**
 * Created by PhpStorm.
 * User: Илья
 * Date: 29.11.2018
 * Time: 2:03
 */
namespace  Corp\Repositories;
use Corp\Menu;
use Illuminate\Support\Facades\Gate;

class MenusRepository extends Repository
{

    public function __construct(Menu$menu)
    {
        $this->model=$menu;
    }

    public function addMenu($request)
    {
        if (Gate::denies('save',$this->model)){
            abort(403);
        }
        $data=$request->only('type','title','parent');

     // dd($request->all());

        if (empty($data)){
            return ['error'=>'Нет данных'];
        }

        switch ($data['type']){
            case 'customLink': $data['path']=$request->input('custom_link');
            break;
            case 'blogLink':
                if ($request->input('category_alias')){
                    if ($request->input('category_alias') =='parent'){
                        $data['path']=route('articles.index');
                    }
                    else{
                        $data['path']=route('articlesCat',['cat_alias'=>$request->input('category_alias')]);
                    }
                }

                    else if ($request->input('article_alias')){
                        $data['path']=route('articles.show',['alias'=>$request->input('article_alias')]);

                }
                break;

            case 'portfolioLink' :
                if ($request->input('filter_alias')) {
                    if ($request->input('filter_alias') == 'parent') {
                        $data['path']=route('portfolios.index');
                    }
                }
                elseif ($request->input('portfolio_alias')){
                    $data['path']=route('portfolios.show',['alias'=>$request->input('portfolio_alias')]);
                }
                break;

            default:
                $data['path']=route('home');


        }
        //dd($data);
        unset($data['type']);
        if ($this->model->fill($data)->save()){
            return ['status'=>'Ссылка добавлена'];
        }

    }


}