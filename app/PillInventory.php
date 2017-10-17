<?php
namespace fase2;
use Illuminate\Database\Eloquent\Model;
//use fase2\User;

class PillInventory extends Model
{
	protected $table = "pills_inventory";

	//protected $fillable = ['name','last_name','mother_last_name','email'];

	public function pill(){
		return $this->belongsTo(CatPill::class); 
	}

	public function delete()
    {
        return parent::delete();
    }
}
