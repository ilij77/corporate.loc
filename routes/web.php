<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource ('/', 'IndexController')->only('index')->names(['index'=>'home']) ;


Route::resource ('portfolios','PortfolioController',[
    'parameters'=>[
        'portfolios'=>'alias'
    ]
]);


Route::resource('articles','ArticlesController',[
    'parameters'=>[
        'articles'=>'alias'
    ]
]);

Route::get('articles/cat/{cat_alias?}',['uses'=>'ArticlesController@index','as'=>'articlesCat']);

Route::  resource('comment','CommentController',['only'=>['store']]);
Route::match(['get','post'],'/contacts',['uses'=>'ContactsController@index','as'=>'contacts']);


Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login','Auth\LoginController@login');
Route::get('logout','Auth\LoginController@logout')->name('logout');


//Route::resource('admin','Admin\IndexController')->only('index')->name('admin.index');



Route::prefix('admin')->name('admin.')->middleware('auth')->group(function (){

    Route::get('/',['uses'=>'Admin\IndexController@index','as'=>'index']);

    Route::resource('/articles','Admin\ArticlesController');
    Route::resource('/permissions','Admin\PermissionsController');


    
    //Route::get('articles',['uses'=>'Admin\ArticlesController@index','as'=>'admin.articles']);

    //Route:: resource ('articles','Admin\ArticlesController');
//Route::resource ('/', 'IndexController')->only('index')->names(['index'=>'home']) ;

});
