<?php

namespace fase2;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = "sales";

	//protected $fillable = ['name','last_name','mother_last_name','email'];

	public function client(){
		return $this->belongsTo(Client::class); 
	}
	public function company(){
		return $this->belongsTo(Company::class); 
	}
	public function package(){
		return $this->belongsTo(CatPackage::class); 
	}
	public function pill(){
		return $this->belongsTo(CatPill::class); 
	}
	public function product(){
		return $this->belongsTo(CatProduct::class); 
	}
	public function service(){
		return $this->belongsTo(CatService::class); 
	}
	public function user(){
		return $this->belongsTo(User::class); 
	}

	public function delete()
    {
        return parent::delete();
    }
}
