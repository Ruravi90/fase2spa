<?php
namespace fase2\Http\Controllers;
use fase2\CatPackage;
use Illuminate\Http\Request;
use fase2\Http\Requests\CatPackageRequest;

class CatPackageController extends Controller
{
    //
    public function index(){
    	return view('cat_package.index');
    }

    // Api rest
    public function getAll(){
        $packages =  CatPackage::all();
        return response($packages, 200)->header('Content-Type', 'application/json');
    }

    public function find($id){
        $package = CatPackage::find($id);
        return response($package, 200)->header('Content-Type', 'application/json');
    }

	public function add(CatPackageRequest $request){

		$package = new CatPackage;
		$package->name = $request->get('name');
		$package->save();

		return ['success' => true]; 
	}

    public function update($id,CatPackageRequest $request){// se envia el id a $client 
    	//dd($client->address()->first()->id); //saber que contiene la variable

    	$package = CatPackage::find($id);
		$package->name = $request->get('name');
		$package->save();
    	return ['success' => true]; 
    }

    public function delete($id){// se envia el id a $client 
        $package = CatPackage::find($id);
		$package->delete();
    	return ['success' => true]; 
    }
}

