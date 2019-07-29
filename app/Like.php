<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    public function Recipe()
    {
    	return $this->belongsTo('App\Recipe', 'like');
    }

    public function User()
    {
    	return $this->belongsTo('App\User', 'like');
    }
}
