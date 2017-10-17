<?php

namespace fase2\Http\Controllers;

use Illuminate\Http\Request;
use fase2\CatPill;
use Illuminate\Http\Request;
use fase2\Http\Requests\CatPillRequest;

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

	public function add(CatPillRequest $request){
        $products = CatPill::create(
            $request->only('name','counter')
        );

        return ['success' => true]; 
	}

    public function update($id,CatPillRequest $request){// se envia el id a $client 
    	$product = CatPill::find($id);
		$product->update(
            $request->only('name','counter')
        );
    	return ['success' => true]; 
    }

    public function delete($id){// se envia el id a $client 
        $product = CatPill::find($id);
		$product->delete();
    	return ['success' => true]; 
    }
}
