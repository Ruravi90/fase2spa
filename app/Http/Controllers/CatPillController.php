<?php
namespace fase2\Http\Controllers;
use Illuminate\Http\Request;
use fase2\CatPill;

class CatPillController extends Controller
{
    public function index(){
    	return view('cat_pill.index');
    }

    // Api rest
    public function getAll(){ 
        $products =  CatPill::all();
        return response($products, 200)->header('Content-Type', 'application/json');
    }

    public function find($id){
        $product = CatPill::find($id);
        return response($product, 200)->header('Content-Type', 'application/json');
    }

	public function add(Request $request){
        $pill =new CatPill;
        $pill->name = $request->get('name');
        $pill->price = $request->get('price');
        $pill->save();
        return ['success' => true]; 
	}

    public function update($id,Request $request){// se envia el id a $client 
    	$pill = CatPill::find($id);
		$pill->name = $request->get('name');
        $pill->price = $request->get('price');
        $pill->save();
    	return ['success' => true]; 
    }

    public function delete($id){// se envia el id a $client 
        $product = CatPill::find($id);
		$product->delete();
    	return ['success' => true]; 
    }
}
