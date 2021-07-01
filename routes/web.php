<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/' , 'PageController@index');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')
        ->namespace('Admin')
        ->middleware('auth')
        ->name('admin.')
        ->group(function(){
            //qui si mettono tutte le rotte ADMIN  ( il nostro CRUD)
            Route::get('/', 'HomeController@index')->name('home');
            Route::resource('/posts', 'PostController');
        });
