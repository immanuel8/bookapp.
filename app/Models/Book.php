<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
// namespace App\Models;

class Book extends Model 

{
    // use Authenticatable, Authorizable, HasFactory;

   
    protected $fillable = [
        'title', 'description','author'
    ];

   
    // protected $hidden = [
    //     'password',
    // ];
}
