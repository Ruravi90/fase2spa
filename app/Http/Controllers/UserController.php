<?php

namespace fase2\Http\Controllers;
use fase2\User;
use fase2\Http\Controllers\Controller;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{

    public function index()
    {
        return view('user.index');
    }

    // Api rest
    public function validateUsername(Request $request){
        if($request->get('username') == '')
            return ['success' => false]; 

        $user = User::where('username',$request->get('username'))->first();
        if($user == null)
            return ['success' => true]; 
        else
            return ['success' => false]; 
    }

	public function add(Request $request){
        $user = new User;
        $user->username = $request->get('username');
        $user->name = $request->get('name');
        $user->lastname = $request->get('lastname');
        $user->motherlastname = $request->get('motherlastname');
        $user->email = $request->get('email');
        foreach ($request->input("roles") as $key => $value) {
           $user->assignRole($value["id"]);
        }
        $user->save();
		return ['success' => true]; 
	}

    public function update($id,Request $request){// se envia el id a $client 
		$user = User::find($id);
		$user->username = $request->get('username');
		$user->name = $request->get('name');
		$user->lastname = $request->get('lastname');
		$user->motherlastname = $request->get('motherlastname');
		$user->email = $request->get('email');
        $user->revokeAllRoles();
		$user->save();
        foreach ($request->input("roles") as $key => $value) {
           $user->assignRole($value["id"]);
        }
        $user->save();
    	return ['success' => true]; 
    }

    public function delete($id){
    	$user = User::find($id);
		$user->delete();
    	return ['success' => true]; 
    }

    public function getAll(){
        $user = User::all();
        return response($user, 200)->header('Content-Type', 'application/json');
    }

    public function find($id){
        $user = User::with('roles')->find($id);
        return response($user, 200)->header('Content-Type', 'application/json');
    }
}
