<?php
namespace fase2;
use Illuminate\Database\Eloquent\Model;
//use fase2\User;

class CatPackage extends Model
{
	protected $table = "cat_packages";

	//protected $fillable = ['name','last_name','mother_last_name','email'];
	public function sales(){
		return $this->hasMany(Sale::class);
		//return $this->belongsTo(Address::class);
	}

	public function delete()
    {
        return parent::delete();
    }
}
