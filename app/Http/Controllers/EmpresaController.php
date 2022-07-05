<?php

namespace App\Http\Controllers;

use App\Models\{Empresa, User, Servicios};
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresa = Empresa::first();
        $servicios = Servicios::all();
        $medicos = User::whereRolId(2)->get();
        $pacientes = User::whereRolId(4)->get();
        return view('config.empresa', compact('empresa', 'servicios', 'pacientes', 'medicos'));
    }

    public function update( Request $request )
    {
        $empresa = Empresa::first();
        $empresa->nombre = $request->nombre;
        $empresa->documento = $request->documento;
        $empresa->direccion = $request->direccion;
        $empresa->telefono = $request->telefono;
        $empresa->correo = $request->correo;
        $empresa->web = $request->web;

        if ($request->logo != null) {
            $empresa->logo = $this->upload_global($request->file('logo'), 'logos');
        }
        $empresa->save();

        return back()->with('success', 'Informacion Actualizada con exito');
    }


    function upload_global($file, $folder)
    {

        $file_type = $file->getClientOriginalExtension();
        $folder = $folder;
        $destinationPath = public_path() . '/uploads/' . $folder;
        $destinationPathThumb = public_path() . '/uploads/' . $folder . 'thumb';
        $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
        $url = '/uploads/' . $folder . '/' . $filename;

        if ($file->move($destinationPath . '/', $filename)) {
            return $filename;
        }
    }


}
