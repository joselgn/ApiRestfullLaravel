<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [//Podem ser preenchidos
      'veiculo', 'descricao', 'marca','ano','vendido'
    ];//fillable
  
    protected $guarded = ['id', 'created_at', 'update_at'];
    
        
}//class
