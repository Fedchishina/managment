<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
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
        'last_name',
        'first_name',
        'email',
        'is_active',
        'group_id',
        'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //'password',
        'remember_token',
        'api_token'
    ];

    public static $rules = [
        'last_name' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'is_active' => 'boolean',
        //'group_id' => 'required',
    ];
}
