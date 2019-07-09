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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']], function (){
		Route::get('dashboard','DashboardController@index')->name('dashboard');
		Route::resource('user', 'UserController');
		Route::resource('category', 'CategoryController');
		Route::resource('post', 'PostController');
		Route::resource('recipe', 'RecipeController');
});


Route::group(['as'=>'author.','prefix'=>'author','namespace'=>'Author','middleware'=>['auth','author']], function (){
		Route::get('home','HomeController@index')->name('home');
		Route::resource('profile','ProfileController');
		Route::resource('recipe','RecipesController');

		//Vue route
		Route::post('saveFollow/{profile}', 'FollowsController@saveFollow');
});
