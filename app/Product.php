<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Gloudemans\Shoppingcart\Contracts\Buyable;

class Product extends Model implements Buyable
{
    //mass fillable attributes
	protected $fillable = ['name', 'brand', 'type', 'description', 'size', 'quantity', 'quantity_sold', 'price'];


	    public function getBuyableIdentifier($options = null){
	        return $this->id;
	    }

	    public function getBuyableDescription($options = null){
	        return $this->name;
	    }

	    public function getBuyablePrice($options = null){
	        return $this->price;
	    }
}
