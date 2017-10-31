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
        $package = CatPackage::create(
            $request->only('name','price')
        );

		return ['success' => true]; 
	}

    public function update($id,CatPackageRequest $request){// se envia el id a $client 
    	$package = CatPackage::find($id);
		$package->update(
            $request->only('name','price')
        );
    	return ['success' => true]; 
    }

    public function delete($id){// se envia el id a $client 
        $package = CatPackage::find($id);
		$package->delete();
    	return ['success' => true]; 
    }
}

