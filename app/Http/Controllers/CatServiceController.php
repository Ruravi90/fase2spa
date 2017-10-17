<?php
namespace fase2\Http\Controllers;
use fase2\CatService;
use Illuminate\Http\Request;
use fase2\Http\Requests\CatServiceRequest;

class CatServiceController extends Controller
{
    //
    public function index(){
    	return view('cat_service.index'); 
    }

    // Api rest
    public function getAll(){
        $services =  CatService::all();
        return response($services, 200)->header('Content-Type', 'application/json');
    }

    public function find($id){
        $service = CatService::find($id);
        return response($service, 200)->header('Content-Type', 'application/json');
    }

	public function add(CatServiceRequest $request){
		$service = new CatService;
		$service->name = $request->get('name');
		$service->save();

		return ['success' => true]; 
	}

    public function update($id,CatServiceRequest $request){// se envia el id a $client 
    	$service = CatService::find($id);
		$service->name = $request->get('name');
		$service->save();
    	return ['success' => true]; 
    }

    public function delete($id){// se envia el id a $client 
        $service = CatService::find($id);
		$service->delete();
    	return ['success' => true]; 
    }
}

