<?php
namespace fase2;
use Illuminate\Database\Eloquent\Model;

class CatPill extends Model
{
    protected $table = "cat_pills";

	//protected $fillable = ['name','price'];

	public function sales(){
		return $this->hasMany(Sale::class); 
	}

	public function inventory(){
		return $this->hasMany(PillInventory::class);
	}

	public function delete()
    {
        return parent::delete();
    }
}
