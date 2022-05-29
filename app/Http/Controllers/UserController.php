<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User};
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
        return view('usuarios', compact('usuarios', 'tipo'));
    }

    public function medicos()
    {
        $usuarios = User::whereRolId(2)->get();
        $tipo = "Medicos";
        return view('usuarios', compact('usuarios', 'tipo'));
    }

    public function farmaceutas()
    {
        $usuarios = User::whereRolId(3)->get();
        $tipo = "Farmaceutas";
        return view('usuarios', compact('usuarios', 'tipo'));
    }

    public function pacientes()
    {
        $usuarios = User::whereRolId(4)->get();
        $tipo = "Pacientes";
        return view('usuarios', compact('usuarios', 'tipo'));
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
            'telefono' => $request->telefono
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
                'telefono' => $request->telefono
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
