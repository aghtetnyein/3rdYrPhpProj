<?php

namespace App\Http\Controllers\Author;


use App\User;
use App\Profile;
use App\Follow;
use App\Recipe;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $user = User::findOrFail($id);

        $follow_check = Follow::where('user_id', auth()->user()->id)
                                ->where('profile_id', $id);
        $follow = $follow_check->count();
        $recipes = Recipe::where('user_id', $user->id)->get();
        $recipes_publish = Recipe::where('user_id', $user->id)
                          ->where('publish', 1)->orderBy('created_at', 'desc')->get();

        $recipes = auth()->user()->saves()->pluck('recipe_id');
        $recipes_shared = Recipe::whereIn('id', $recipes)->latest()->get();

        $recipes_draft = Recipe::where('user_id', auth()->user()->id)
                        ->where('publish', 0)->orderBy('created_at', 'desc')->get();

        return view('author.profile.index', compact('user', 'recipes', 'recipes_publish', 'recipes_shared', 'recipes_draft', 'follow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $this->authorize('update', $user->profile);

        return view('author.profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
        $this->authorize('update', $profile);
        $this->validate($request,[
          'url' => 'url',
          'about' => 'required',
          'image' => 'image',
        ]);

        $image = $request->file('image');
        $slug = str_slug(auth()->user()->username);
        if(isset($image))
        {
            //make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('profile'))
            {
                Storage::disk('public')->makeDirectory('profile');
            }

            if(Storage::disk('public')->exists('profile/'.$profile->image))
            {
                if ($profile->image != 'avatar1.png') {
                    Storage::disk('public')->delete('profile/'.$profile->image);
                }
            }

            $profileImage = Image::make($image)->save();
            Storage::disk('public')->put('profile/'.$imageName,$profileImage);

        } else {
            $imageName = $profile->image;
        }

        $profile->user_id = Auth::id();
        $profile->url = $request->url;
        $profile->about = $request->about;
        $profile->image = $imageName;

        $profile->save();
        return redirect("/author/profile/{$profile->user->id}");
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
