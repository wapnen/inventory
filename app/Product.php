<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //mass fillable attributes
	protected $fillable = ['name', 'brand', 'type', 'description', 'size', 'quantity', 'quantity_sold', 'price'];
}
