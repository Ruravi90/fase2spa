<?php

namespace fase2\Http\Controllers;

use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index()
    {
        return view('rol.index');
    }

    public function add(Request $request)
    {

        $rol              = new Role;
        $rol->name        = $request->input("rol_nombre");
        $rol->slug        = $request->input("rol_slug");
        $rol->description = $request->input("rol_descripcion");
        if ($rol->save()) {
            return ['success' => true];
        } else {
            return view("mensajes.mensaje_error")->with("msj", "...Hubo un error al agregar ;...");
        }
    }

    public function update(Request $request)
    {
        return ['success' => true];
    }

    public function delete(Request $request)
    {
        return ['success' => true];
    }

}
