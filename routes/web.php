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

Route::get('/', function () {
    if(Auth::check()){
        
    return redirect()->route('index');
       
    }else{
        return view('auth.login');
    }
});

Route::get("/login",function(){
        return redirect('/'); 
    });

Route::get('/home','HomeController@index')->name('index');
// Route::get('/home','HomeController@home')->name('home');

//Menu Calendar
Route::get('/monthly_menu/{yearMonth}','MenuController@monthly_menu')->name('menu.monthly_menu');
Route::get('/calendar_search','MenuController@calendar_search')->name('menu.calendar_search');
Route::get('/daily_menu/{kondate_id}&{timezone}&{category}&{day}&{ym}','MenuController@daily_menu')->name('menu.daily_menu');
Route::get('/single_item/{ryouri_id}','MenuController@single_item')->name('menu.single_item');
Auth::routes();

