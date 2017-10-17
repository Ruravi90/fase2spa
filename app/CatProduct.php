<?php

namespace fase2;

use Illuminate\Database\Eloquent\Model;

//use fase2\User;

class CatProduct extends Model
{
	protected $table = "cat_products";

	protected $fillable = ['name','counter'];

	public function sales(){
		return $this->hasMany(Sale::class);
		//return $this->belongsTo(Address::class);
	}

	public function inventary(){
		return $this->hasMany(ProductInventory::class);
		//return $this->belongsTo(Address::class);
	}

	public function delete()
    { 
        return parent::delete();
    }
}

