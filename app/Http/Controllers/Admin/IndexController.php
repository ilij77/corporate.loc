<?php

namespace Corp\Http\Controllers\Admin;

//use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

//use Gate;

class IndexController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->template = env('THEME') . '.admin.index';



//        if (Gate::denies('VIEW_ADMIN')){
//            dd(Gate::check('VIEW_ADMIN'));
//        };
 }



 public function index()
    {


       $this->user=Auth::user();
       //dd($this->user);
      if ($au= Gate::denies('VIEW_ADMIN')){
          abort(403);
      };


$this->title='Панель администратора';

//dd($this->title);
     //return $this->title;
return$this->renderOutput();
}

}