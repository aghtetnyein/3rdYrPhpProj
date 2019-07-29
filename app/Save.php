<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Save extends Model
{
    //
    public function Recipe()
    {
    	return $this->belongsTo('App\Recipe', 'save');
    }

    public function User()
    {
    	return $this->belongsTo('App\User', 'save');
    }
}
