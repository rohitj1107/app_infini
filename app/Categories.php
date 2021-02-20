<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //
    protected $table = 'categories';

    protected $fillable = [
    	'categorie_name' , 'categorie_parent' , 'status'
    ];
}
