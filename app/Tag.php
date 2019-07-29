<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
	protected $fillable = [
        'name', 'slug'
    ];

    public function recipes()
    {
        return $this->belongsToMany('App\Recipe')->withTimestamps();
    }
}
