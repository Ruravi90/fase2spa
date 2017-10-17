<?php
namespace fase2\Http\Controllers;
use fase2\CatReference;
use Illuminate\Http\Request;
use fase2\Http\Requests\CatReferenceRequest;

class CatReferenceController extends Controller
{
    //
    public function index(){
    	$references = CatReference::orderBy('id','desc')->paginate(10);
    	return view('cat_reference.index')->with(['references'=> $references]);
    }

    // Api rest
    public function getAll(){
        $references =  CatReference::all();
        return response($references, 200)->header('Content-Type', 'application/json');
    }

    public function find($id){
        $reference = CatReference::find($id);
        return response($reference, 200)->header('Content-Type', 'application/json');
    }

	public function add(CatReferenceRequest $request){ 

		$reference = new CatReference;
		$reference->name = $request->get('name');
		$reference->save();

		return ['success' => true]; 
	}

    public function update($id,CatReferenceRequest $request){// se envia el id a $client 
    	//dd($client->address()->first()->id); //saber que contiene la variable

    	$reference = CatReference::find($id);
		$reference->name = $request->get('name');
		$reference->save();
    	return ['success' => true]; 
    }

    public function delete($id){// se envia el id a $client 
        $reference = CatReference::find($id);
		$reference->delete();
    	return ['success' => true]; 
    }
}

