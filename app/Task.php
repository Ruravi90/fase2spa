<?php

namespace fase2;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = "tasks";

	//protected $fillable = ['name','last_name','mother_last_name','email'];

	public function user(){
		return $this->belongsTo(User::class); 
	}

	public function delete()
    {
        return parent::delete();
    }
}
