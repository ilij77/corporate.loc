<?php

namespace Corp\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Lavary\Menu\Menu;



class AdminController extends \Corp\Http\Controllers\Controller
{

    protected $p_rep;
    protected $a_rep;
    protected $user;
    protected $template;
    protected $content=false;
    protected $title;
    protected $vars;

    public function __construct()
    {


    }



    public function renderOutput(){
        $this->vars=array_add($this->vars,'title',$this->title);
        $menu=$this->getMenu();
        //$menu=false;
        $navigation=view(env('THEME').'.admin.navigation')->with('menu',$menu)->render();
        $this->vars=array_add($this->vars,'navigation',$navigation);

//dd(Auth::user());

        if ($this->content){
            $this->vars=array_add($this->vars,'content',$this->content);
        }
        $footer=view(env('THEME').'.admin.footer')->render();
        $this->vars=array_add($this->vars,'footer',$footer);
        return view($this->template)->with($this->vars);
    }

    public function getMenu(){
      return \Menu::make('adminMenu',function ($menu){
       $menu->add('Статьи',route('articles.index'));
       $menu->add('Портфолио',route('articles.index'));
       $menu->add('Меню',route('articles.index'));
       $menu->add('Пользователи',route('articles.index'));
       $menu->add('Привилегии',route('articles.index'));
      });

    }

}
