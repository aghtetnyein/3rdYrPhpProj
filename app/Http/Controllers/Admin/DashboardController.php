<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Category;
use App\Post;
use App\Recipe;

class DashboardController extends Controller
{
    //
    public function index()
    {
    	$users = User::latest()->get();
    	$categories = Category::latest()->get();
    	$posts = Post::latest()->get();
    	$recipes = Recipe::latest()->get();
    	return view( 'admin.dashboard' , compact('users', 'categories', 'posts', 'recipes'));
    }
}
