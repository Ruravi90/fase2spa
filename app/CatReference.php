<?php

namespace fase2;

use Illuminate\Database\Eloquent\Model;

class CatReference extends Model
{

	protected $table = "cat_references";
	//protected $fillable = ['name','last_name','mother_last_name','email'];

	public function clients(){
		return $this->hasMany(Client::class);
	}

	public function delete()
    {
        return parent::delete();

    }

}

