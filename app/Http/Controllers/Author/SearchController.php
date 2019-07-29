<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Recipe;
use App\Category;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->category) {
            $recipes = Recipe::with('categories')->whereHas('categories', function ($query) {
                $query->where('slug', request()->category);
            })->where('publish', 1)->get();
            $categories = Category::all();
        } else {
            $recipes = Recipe::orderBy('created_at', 'desc')->where('publish', 1)->get();
            $categories = Category::all();
            $categoryName = 'Featured';
        }

        if (request()->input('recipeName')){
            $recipeName = request()->input('recipeName');

            $recipes = Recipe::where('title', 'LIKE', "%$recipeName%")->where('publish', 1)->get();
        }

        return view( 'author.search.index', compact('recipes', 'categories'));
    }

    public function searchTag()
    {
        if (request()->category) {
            $recipes = Recipe::with('categories')->whereHas('categories', function ($query) {
                $query->where('slug', request()->category);
            })->where('publish', 1)->get();
            $categories = Category::all();
        } else {
            $recipes = Recipe::orderBy('created_at', 'desc')->where('publish', 1)->get();
            $categories = Category::all();
            $categoryName = 'Featured';
        }

        if (request()->input('tag')){
            $tag = request()->input('tag');

            $recipes = Recipe::with('tags')->whereHas('tags', function ($query) {
                $query->where('name', 'LIKE', "%".request()->input('tag')."%");
            })->where('publish', 1)->get();
            //dd($recipes);
        }

        return view( 'author.search.index', compact('recipes', 'categories'));
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
