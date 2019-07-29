<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use App\Tag;
use App\Recipe;
use App\Like;
use App\Save;

use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class RecipesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('author.recipe.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('author.recipe.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            //'image' => 'required',
            //'categories' => 'required',
            //'tags' => 'required',
            'body' => 'required',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if(isset($image))
        {
            //make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('recipe'))
            {
                Storage::disk('public')->makeDirectory('recipe');
            }

            $recipeImage = Image::make($image)->resize(1600,1066)->save();
            Storage::disk('public')->put('recipe/'.$imageName,$recipeImage);

        } else {
            $imageName = "default.png";
        }
        $forurl = Auth::id();

        $recipe = new Recipe();
        $recipe->user_id = Auth::id();
        $recipe->title = $request->title;
        $recipe->duration = $request->duration;
        $recipe->slug = $slug;
        $recipe->image = $imageName;
        $recipe->body = $request->body;
        if(isset($request->publish))
        {
            $recipe->publish = true;
        }else {
            $recipe->publish = false;
        }

        if(isset($request->chef))
        {
            $recipe->chef = true;
        }else {
            $recipe->chef = false;
        }

        $recipe->save();

        $tags = $request->tags;
        $tags = explode('#', $tags);
        
        foreach ($tags as $tag) {
            $tag = trim($tag);
            $tag_check = Tag::where('name', $tag);

            if ($tag != '') {
                if ( $tag_check->count() == 0 ) {
                    $tag_info = Tag::create([
                        'name' => $tag,
                        'slug' => str_slug($tag)
                    ]);
                }else{
                    $tag_info = $tag_check->first();
                }
                $recipe->tags()->attach($tag_info);
            }else{
               Tag::where('name', '')->delete(); 
            }
        }
        //dd($request->categories, $tags);
        $recipe->categories()->attach($request->categories);
        return redirect("/author/profile/$forurl");
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
        $user = auth()->user();
        $recipe = Recipe::find($id);
        $like_check = $user->like()->where('recipe_id', $id)->count();
        //dd($like_check);
        $save_check = $user->saves()->where('recipe_id', $id)->count();
        //dd($save_check);
        $categories = $recipe->categories()->get();
        $tags = $recipe->tags()->get();
        //dd($categories);
        return view('author.recipe.index', compact('user', 'recipe', 'like_check', 'save_check', 'categories', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipe = Recipe::find($id);
        $categories = Category::all();
        $tags = $recipe->tags()->get();
        return view('author.recipe.edit', compact('categories', 'recipe', 'tags'));
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
        $recipe = Recipe::find($id);
        $this->validate($request,[
            'title' => 'required',
            'image' => 'image',
            //'categories' => 'required',
            //'tags' => 'required',
            'body' => 'required',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        if(isset($image))
        {
            //make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('recipe'))
            {
                Storage::disk('public')->makeDirectory('recipe');
            }

            if(Storage::disk('public')->exists('recipe/'.$recipe->image))
            {
                Storage::disk('public')->delete('recipe/'.$recipe->image);
            }

            $recipeImage = Image::make($image)->resize(1600,1066)->save();
            Storage::disk('public')->put('recipe/'.$imageName,$recipeImage);

        } else {
            $imageName = $recipe->image;
        }
        $forurl = Auth::id();

        $recipe->user_id = Auth::id();
        $recipe->title = $request->title;
        $recipe->duration = $request->duration;
        $recipe->slug = $slug;
        $recipe->image = $imageName;
        $recipe->body = $request->body;
        if(isset($request->publish))
        {
            $recipe->publish = true;
        }else {
            $recipe->publish = false;
        }

        if(isset($request->chef))
        {
            $recipe->chef = true;
        }else {
            $recipe->chef = false;
        }

        $recipe->save();

        $tags = $request->tags;
        $tags = explode('#', $tags);


        DB::table('recipe_tag')->where('recipe_id', $id)->delete();
        
        foreach ($tags as $tag) {
            $tag = trim($tag);
            $tag_check = Tag::where('name', $tag);

            if ($tag != '') {
                if ( $tag_check->count() == 0 ) {
                    $tag_info = Tag::create([
                        'name' => $tag,
                        'slug' => str_slug($tag)
                    ]);
                }else{
                    $tag_info = $tag_check->first();
                }
                $recipe->tags()->attach($tag_info);
            }else{
               Tag::where('name', '')->delete(); 
            }
        }
        //dd($request->categories, $tags);
        $recipe->categories()->sync($request->categories);
        return redirect("/author/profile/$forurl");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipe = Recipe::find($id);
        if (Storage::disk('public')->exists('recipe/'.$recipe->image))
        {
            Storage::disk('public')->delete('recipe/'.$recipe->image);
        }
        $recipe->delete();
        return redirect('/author/home');
    }

    public function saveLike(Request $request)
    {
        $likecheck = Like::where('user_id', auth()->user()->id)
                            ->where('recipe_id', $request->id)
                            ->first();

        if ($likecheck) {
            Like::where('user_id', auth()->user()->id)
                ->where('recipe_id', $request->id)
                ->delete();
            return 'deleted';
        }else{
            $like = new Like;
            $like->user_id = auth()->user()->id;
            $like->recipe_id = $request->id;
            $like->save();
        }

        $liked = Like::where('user_id', auth()->user()->id)
                            ->where('recipe_id', $request->id)
                            ->first();
        if($liked) {
            return 'liked';
        }
    }

    public function save(Request $request)
    {
        $savecheck = Save::where('user_id', auth()->user()->id)
                            ->where('recipe_id', $request->id)
                            ->first();

        if ($savecheck) {
            Save::where('user_id', auth()->user()->id)
                ->where('recipe_id', $request->id)
                ->delete();
            return 'deleted';
        }else{
            $save = new Save;
            $save->user_id = auth()->user()->id;
            $save->recipe_id = $request->id;
            $save->save();
        }

        $saved = Save::where('user_id', auth()->user()->id)
                            ->where('recipe_id', $request->id)
                            ->first();
        if($saved) {
            return 'saved';
        }
    }

    public function getAllRecipes()
    {
        return $recipes = Recipe::with('likes')->orderBy('created_at', 'desc')->paginate(5);
    }

    public function getLikes()
    {
        return $likes = Auth::user()->like->all();
    }
}
