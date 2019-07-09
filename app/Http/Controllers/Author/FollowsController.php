<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Follow;


class FollowsController extends Controller
{
    //
    public function store(User $user)
    {
    	return auth()->user()->following()->toggle($user->profile);
    }

    public function saveFollow(Request $request)
    {
    	$followcheck = Follow::where('user_id', auth()->user()->id)
    						->where('profile_id', $request->id)
    						->first();

    	if ($followcheck) {
    		Follow::where('user_id', auth()->user()->id)
				->where('profile_id', $request->id)
				->delete();
    		return 'deleted';
    	}else{
    		$follow = new Follow;
	    	$follow->user_id = auth()->user()->id;
	    	$follow->profile_id = $request->id;
	    	$follow->save();
    	}

    	$followed = Follow::where('user_id', auth()->user()->id)
    						->where('profile_id', $request->id)
    						->first();
    	if($followed) {
    		return 'followed';
    	}
    }
}
