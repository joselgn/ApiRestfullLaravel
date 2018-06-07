<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [//Podem ser preenchidos
        'active', 'phone', 'birth','name','email'
    ];//fillable
  
    protected $guarded = [
        'id', 'created_at', 'update_at'
    ];//guarded
}//user calss
