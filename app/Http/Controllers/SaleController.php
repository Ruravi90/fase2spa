<?php

namespace fase2\Http\Controllers;

use Illuminate\Http\Request;

class SaleController extends Controller
{
   	public function index()
	{
		return view('sale.index');
	}

    // Api rest
	public function getAll(){
		$sale =  Sale::all();
		return response($sale, 200)->header('Content-Type', 'application/json');
	}

	public function findClientId($id){
		$client = Client::with('sale')->find($id);
		return response($client, 200)->header('Content-Type', 'application/json');
	}

	public function findProductId($id){
		$product = Product::with('sale')->find($id);
		return response($product, 200)->header('Content-Type', 'application/json');
	}

	public function findPackageId($id){
		$package = Package::with('sale')->find($id);
		return response($package, 200)->header('Content-Type', 'application/json');
	}

	public function findServiceId($id){
		$service = Service::with('sale')->find($id);
		return response($provider, 200)->header('Content-Type', 'application/json');
	}

	public function findUserId($id){
		$user = User::with('sale')->find($id);
		return response($user, 200)->header('Content-Type', 'application/json');
	}

	public function add(ProviderRequest $request){
		$sale = new Sale;
		$sale->product_id = $request->get('product_id');
		$sale->package_id = $request->get('package_id');
		$sale->service_id = $request->get('service_id');
		$sale->client_id = $request->get('client_id');
		$sale->user_id = $request->get('user_id');
		$sale->service_id = $request->get('service_id');
		$sale->description = $request->get('description'); 

		if ($request->has('amount')) {
		    //
		    $count = intval($request->get('count'));
		    $price = floatval($request->get('price'));
		    $amount = floatval($request->get('amount'));

	    	$total = $price * $count;

	    	$sale->is_paid = ($total == $amount); 

	    	$sale->count = $count; 
			$sale->price = $price; 
			$sale->amount = $amount; 

			$sale->save();
		}

		
		return response($sale, 200)->header('Content-Type', 'application/json');
	}

    public function update($id,ProviderRequest $request){// se envia el id a $client 
    	$provider = Provider::find($id);
    	$provider->business_name = $request->get('business_name');
    	$provider->contact_name = $request->get('contact_name');
    	$provider->office_phone = $request->get('office_phone');
    	$provider->email = $request->get('email');
    	$provider->save();
    	$address = $provider->address()->first();

    	if($address == null && $request->has('street')){
    		$address = new Address;
    		$address->name = $request->get('street');
    		$address->inner_number = $request->get('inner_number');
    		$address->outdoor_number = $request->get('outdoor_umber');
    		$address->postal_code = $request->get('postal_code');
    		$address->town = $request->get('town');
    		$address->state = $request->get('state');
    		$address->provider_id = $provider->id;
    		$address->save();

    	}

    	else if($address != null){
    		$address->name = $request->get('street');
    		$address->inner_number = $request->get('inner_number');
    		$address->outdoor_number = $request->get('outdoor_umber');
    		$address->postal_code = $request->get('postal_code');
    		$address->town = $request->get('town');
    		$address->state = $request->get('state');
    		$address->save();
    	}

		//$client = Clien::update($request->only('name','last_name','mother_last_name'));
    	return response($provider, 200)->header('Content-Type', 'application/json');
    }

    public function delete($id){// se envia el id a $client 
    	$provider = Provider::find($id);
    	$provider->delete();
    	return ['success' => true];  
    }
}
