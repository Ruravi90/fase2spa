<?php
namespace fase2\Http\Controllers;
use fase2\CatProduct;
use Illuminate\Http\Request;
use fase2\Http\Requests\CatProductRequest;

class CatProductController extends Controller
{
    //
    public function index(){
    	return view('cat_product.index');
    }

    // Api rest
    public function getAll(){
        $products =  CatProduct::all();
        return response($products, 200)->header('Content-Type', 'application/json');
    }

    public function find($id){
        $product = CatProduct::find($id);
        return response($product, 200)->header('Content-Type', 'application/json');
    }

	public function add(CatProductRequest $request){
        $products = CatProduct::create(
            $request->only('name','counter')
        );

        return ['success' => true]; 
	}

    public function update($id,CatProductRequest $request){// se envia el id a $client 
    	$product = CatProduct::find($id);
		$product->update(
            $request->only('name','counter')
        );
    	return ['success' => true]; 
    }

    public function delete($id){// se envia el id a $client 
        $product = CatProduct::find($id);
		$product->delete();
    	return ['success' => true]; 
    }
}

