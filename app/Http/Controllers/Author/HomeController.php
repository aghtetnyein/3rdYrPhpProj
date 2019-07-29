<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Recipe;
use App\Category;
use App\User;

class HomeController extends Controller
{
    //
    public function index()
    {

    	if (request()->category) {
          // code...
            $recipes = Recipe::with('categories')->whereHas('categories', function ($query) {
                $query->where('slug', request()->category);
            })->get();
            $categories = Category::all();
            $users = User::inRandomOrder()->get();
        } else {
            $users = auth()->user()->follows()->pluck('profile_id');
            $recipes = Recipe::whereIn('user_id', $users)->where('publish', 1)->latest()->get();
            $categories = Category::all();
            $users = User::inRandomOrder()->get();
            $categoryName = 'Featured';
        }

        // $user = User::find(1);
        // dd($user->profile->image);
        
    	return view( 'author.home', compact('recipes', 'categories', 'users'));
    }
}
