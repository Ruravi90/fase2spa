<?php

namespace fase2;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = "payments";

	//protected $fillable = ['name','last_name','mother_last_name','email'];

	public function sale(){
		return $this->belongsTo(Sale::class); 
	}

	public function user(){
		return $this->belongsTo(User::class); 
	}

	public function delete()
    {
        return parent::delete();
    }
}
