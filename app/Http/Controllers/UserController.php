<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Servicios, User};
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $val = User::whereUser($request->usuario)->wherePassword("a1Bz20ydqelm8m1wql" . md5($request->clave))->count();
        if ($val > 0) {
            $val = User::whereUser($request->usuario)->wherePassword("a1Bz20ydqelm8m1wql" . md5($request->clave))->first();
            Auth::loginUsingId($val->id);
            return back();
        } else {
            return redirect()->route('index')->with('danger', 'Usuario o Contraseña Errada.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }

    public function administradores()
    {
        $usuarios = User::whereRolId(1)->get();
        $tipo = "Administradores";
        $servicios = Servicios::all();
        $medicos = User::whereIdRol(2);
        $pacientes = User::whereIdRol(4);
        return view('usuarios', compact('usuarios', 'tipo', 'servicios', 'pacientes', 'medicos'));
    }

    public function medicos()
    {
        $usuarios = User::whereRolId(2)->with('servicio')->get();
        $tipo = "Medicos";
        $servicios = Servicios::all();
        $medicos = User::whereIdRol(2);
        $pacientes = User::whereIdRol(4);
        return view('usuarios', compact('usuarios', 'tipo','servicios', 'pacientes', 'medicos'));
    }

    public function farmaceutas()
    {
        $usuarios = User::whereRolId(3)->get();
        $tipo = "Farmaceutas";
        $servicios = Servicios::all();
        $medicos = User::whereIdRol(2);
        $pacientes = User::whereIdRol(4);
        return view('usuarios', compact('usuarios', 'tipo','servicios', 'pacientes', 'medicos'));
    }

    public function pacientes()
    {
        $usuarios = User::whereRolId(4)->get();
        $tipo = "Pacientes";
        $servicios = Servicios::all();
        $medicos = User::whereIdRol(2);
        $pacientes = User::whereIdRol(4);
        return view('usuarios', compact('usuarios', 'tipo','servicios', 'pacientes', 'medicos'));
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'user' => $request->user,
            'rol_id' => $request->rol_id,
            'password' => 'a1Bz20ydqelm8m1wql' . md5($request->password),
            'email' => $request->email,
            'photo' => $this->upload_global($request->file('photo'), 'perfiles'),
            'telefono' => $request->telefono,
            'idServicio' => $request->idServicio,
            'document' => $request->document
        ]);

        return back()->with('success', 'Usuario Creado correctamente');
    }

    public function update(Request $request)
    {
        $usuario = User::updateOrCreate(
            [
                'id' => $request->idUsuario,
            ],
            [
                'name' => $request->name,
                'last_name' => $request->last_name,
                'user' => $request->user,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'idServicio' => $request->especialidad,
            ]
        );

        if($request->photo != null){$usuario->photo = $this->upload_global($request->file('photo'), 'perfiles');}
        if($request->password != null){$usuario->password = 'a1Bz20ydqelm8m1wql' . md5($request->password);}

        $usuario->save();

        return back()->with('success', 'Usuario Editado correctamente');
    }

    public function get(User $usuario)
    {
        return $usuario;
    }

    public function validardocumento($document)
    {
        $val = User::whereDocument($document)->count();

        return $val;
    }

    public function getMedicosByServcicio($idServicio)
    {
        $medicos = User::whereRolId(2)->where('idServicio', $idServicio)->get();
        $html = "<option value=''>-- SELECCIONE --</option>";

        foreach ($medicos as $medico ) {
            $html .= "<option value='$medico->id'>$medico->name $medico->last_name</option>";
        }

        return $html;
    }

    public function listadoRecetas()
    {
        $usuarios = User::whereRolId(4)->with(['citas_data', 'citas_data.diagnostico', 'citas_data.diagnostico.recetas'])->get();
        $servicios = Servicios::all();
        $medicos = User::whereIdRol(2);
        $pacientes = User::whereIdRol(4);
        return view('farmacias.list', compact('usuarios','servicios', 'pacientes', 'medicos'));
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
