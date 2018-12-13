<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Http\Requests\ArticleRequest;
use Corp\Repositories\ArticlesRepository;
use Corp\Repositories\MenusRepository;
use Corp\Repositories\PortfoliosRepository;
use Illuminate\Http\Request;
use Corp\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Lavary\Menu\Menu;

class MenusController extends AdminController
{

    protected $m_rep;

    public function __construct(MenusRepository$m_rep,ArticlesRepository $a_rep,PortfoliosRepository $p_rep)
    {
        parent::__construct();
        $this->m_rep=$m_rep;
        $this->a_rep=$a_rep;
        $this->p_rep=$p_rep;
        $this->template=env('THEME').'.admin.menus';


    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->user=Auth::user();
        if ( Gate::denies('VIEW_ADMIN_MENU')){
            abort(403);
        };

      //dd($this->user);
        $menu=$this->getMenus();
        //dd($menu);
        $this->content=view(env('THEME').'.admin.menus_content')->with('menus',$menu)->render();
        return $this->renderOutput();


    }


    public function getMenus()
    {
        $menu=$this->m_rep->get();
        if ($menu->isEmpty()){
            return false;

        }

        return \Menu::make('forMenuPart',function ($m) use($menu){
            foreach ($menu as $item) {
                if ($item->parent==0){
                    $m->add($item->title,$item->path)->id($item->id);
                }
                else{
                    if ($m->find($item->parent)){
                        $m->find($item->parent)->add($item->title,$item->path)->id($item->id);
                    }
                }
            }
        });

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
