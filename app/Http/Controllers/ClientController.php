<?php
namespace fase2\Http\Controllers;
use fase2\Client;
use fase2\Address;
use fase2\CatReference;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use fase2\Http\Requests\ClientRequest;


class ClientController extends Controller
{
    public function index(){
    	return view('client.index');
    }

    // Api rest
	public function add(ClientRequest $request){
		if(intval($request->get('reference_id')) == 0){
			$reference = new CatReference;
			$reference->name = $request->get('other_ref');
			$reference->save();
		}
		else
			$reference = CatReference::find($request->get('reference_id'));

		$client = new Client;
		$client->name = $request->get('name');
		$client->lastname = $request->get('lastname');
		$client->motherlastname = $request->get('motherlastname');
		$client->email = $request->get('email');
		$client->phone_home = $request->get('phone_home');
		$client->phone_mobile = $request->get('phone_mobile');
		$client->reference_id = $reference->id; 
		$client->save();

		if($request->get('street') != null){
			$address = new Address;
			$address->name = $request->get('street');
			$address->inner_number = $request->get('inner_number');
			$address->outdoor_number = $request->get('outdoor_umber');
			$address->postal_code = $request->get('postal_code');
			$address->town = $request->get('town');
			$address->state = $request->get('state');
			$address->client_id = $client->id;
			$address->save();
		}

		//auth()->user->id obtener usuario legueado
		//\App::user->id
		////$request->user->id
		//$client = Clien::create($request->only('name','last_name','mother_last_name'));
		return ['success' => true]; 
	}

    public function update($id,ClientRequest $request){// se envia el id a $client 
    	//dd($client); //saber que contiene la variable 
    	if(intval($request->get('reference_id')) == 0){
			$reference = new CatReference;
			$reference->name = $request->get('other_ref');
			$reference->save();
		}
		else
			$reference = CatReference::find($request->get('reference_id'));

    	$client = Client::find($id);
		$client->name = $request->get('name');
		$client->lastname = $request->get('lastname');
		$client->motherlastname = $request->get('motherlastname');
		$client->email = $request->get('email');
		$client->phone_home = $request->get('phone_home');
		$client->phone_mobile = $request->get('phone_mobile');
		$client->reference_id = $reference->id;
		$client->save();

		$address = $client->address()->first();
		if($address == null && $request->has('street')){
			$address = new Address;
			$address->name = $request->get('street');
			$address->inner_number = $request->get('inner_number');
			$address->outdoor_number = $request->get('outdoor_umber');
			$address->postal_code = $request->get('postal_code');
			$address->town = $request->get('town');
			$address->state = $request->get('state');
			$address->client_id = $client->id;
			$address->save();
		}
		else if($address != null && $request->has('street')){
			$address->name = $request->get('street');
			$address->inner_number = $request->get('inner_number');
			$address->outdoor_number = $request->get('outdoor_umber');
			$address->postal_code = $request->get('postal_code');
			$address->town = $request->get('town');
			$address->state = $request->get('state');
			$address->save();
		}

		//$client = Clien::update($request->only('name','last_name','mother_last_name'));
    	return ['success' => true]; 
    }

    public function delete($id){// se envia el id a $client 
    	$client = Client::find($id);
		$client->delete();
    	return ['success' => true]; 
    }


    public function getAll(){
        $clients =  Client::all();
        return response($clients, 200)->header('Content-Type', 'application/json');
    }

    public function find($id){
        $client = Client::with('address')->find($id);
        return response($client, 200)->header('Content-Type', 'application/json');
    }
}