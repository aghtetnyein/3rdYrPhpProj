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
		Route::get('searchItem','SearchController@index')->name('searchItem');
		Route::resource('profile','ProfileController');
		Route::resource('recipe','RecipesController');
		Route::resource('notifications','NotificationsController');
		Route::resource('shoppinglist','ShoppingListController');
		Route::resource('search','SearchController');

		//Vue route
		Route::post('saveFollow/{profile}', 'FollowsController@saveFollow');
		Route::post('saveLike/{recipe}', 'RecipesController@saveLike');
		Route::post('save/{recipe}', 'RecipesController@save');

		Route::post('getRecipes', 'RecipesController@getAllRecipes');
		Route::post('getLikes', 'RecipesController@getLikes');

		//each
		Route::get('item_search', 'SearchController@index')->name('itemsearchName');
		Route::get('item_search_Tag', 'SearchController@searchTag')->name('itemsearchTag');
		//Route::get('item_search_Tag', 'SearchController@index')->name('itemsearchTag');

		//shoppinglist
		Route::post('shoppinglist/create', 'ShoppingListController@create');
		Route::post('shoppinglist/delete', 'ShoppingListController@delete');
		Route::post('shoppinglist/update', 'ShoppingListController@updateItem');
		//Route::get('shoppinglist/search', 'ShoppingListController@search');
		
});

Route::get('/search', 'Author\ShoppingListController@search');
