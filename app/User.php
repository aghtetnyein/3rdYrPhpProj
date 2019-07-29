<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->profile()->create([
               'title' => $user->name,
            ]);
        });
    }

    public function profile(){
        return $this->hasOne('App\Profile');
    }

    public function shoppingLists(){
        return $this->hasMany('App\ShoppingList');
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function recipes()
    {
        return $this->hasMany('App\Recipe');
    }

    public function follows()
    {
        return $this->hasMany('App\Follow');
    }

    public function like()
    {
        return $this->hasMany('App\Like');
    }

    public function saves()
    {
        return $this->hasMany('App\Save');
    }
}
