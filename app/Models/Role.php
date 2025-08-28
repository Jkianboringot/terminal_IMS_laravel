<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

     protected $fillable = ['title','permissions'];

         protected $casts = [
        'permissions' => 'array',
    ];
       function users(){
        return $this->belongsToMany(User::class,'role_user');
    }
}
