<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $table = 'products';

    protected $fillable = [
    	'product_name' , 'product_description' , 'categorie' , 'status'
    ];
}
