<?php

namespace fase2\Http\Controllers;

use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function add(Request $request)
    {
        $permiso              = new Permission;
        $permiso->name        = $request->input("permiso_nombre");
        $permiso->slug        = $request->input("permiso_slug");
        $permiso->description = $request->input("permiso_descripcion");
        if ($permiso->save()) {
            return ['success' => true];
        } else {
            return view("mensajes.mensaje_error")->with("msj", "...Hubo un error al agregar ;...");
        }

    }

    public function toAssign(Request $request)
    {

        $roleid = $request->input("rol_sel");
        $idper  = $request->input("permiso_rol");
        $rol    = Role::find($roleid);
        $rol->assignPermission($idper);

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
