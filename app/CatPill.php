<?php

namespace fase2;

use Illuminate\Database\Eloquent\Model;

class CatPill extends Model
{
    protected $table = "cat_pills";

	//protected $fillable = ['name','last_name','mother_last_name','email'];
	public function sales(){
		return $this->hasMany(Sale::class);
		//return $this->belongsTo(Address::class);
	}

	public function inventary(){
		return $this->hasMany(PillInventory::class);
		//return $this->belongsTo(Address::class);
	}

	public function delete()
    {
        return parent::delete();
    }
}
