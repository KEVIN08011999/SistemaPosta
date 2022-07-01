<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{BloquesHorarios, Citas, PagosPaciente, Servicios, User};

class CitasController extends Controller
{
    public function index()
    {
        $citas = Citas::with(['medico', 'paciente', 'horario', 'servicio'])->get();

        $medicos = User::whereRolId(2)->get();
        $pacientes = User::whereRolId(4)->get();
        $horarios = BloquesHorarios::all();
        $servicios = Servicios::all();
        return view('citas', compact('citas', 'medicos', 'pacientes', 'horarios', 'servicios'));
    }

    public function citasSis()
    {
        $citas = Citas::where('sis', 1)->with(['medico', 'paciente', 'horario', 'servicio'])->get();
        $medicos = User::whereRolId(2)->get();
        $pacientes = User::whereRolId(4)->get();
        $horarios = BloquesHorarios::all();
        $servicios = Servicios::all();

        return view('citas', compact('citas', 'medicos', 'pacientes', 'horarios', 'servicios'));
    }

    public function store(Request $request)
    {
        $validacion = Citas::where('idMedico', $request->idMedico)
            ->where('idPaciente', $request->idPaciente)
            ->where('fecha', $request->fecha)
            ->where('idHorario', $request->idHorario)
            ->count();

        $medico = User::whereId($request->idMedico)->first();

        if ($validacion == 0)
        {
            $cita = Citas::create([
                'idMedico' => $request->idMedico,
                'idPaciente' => $request->idPaciente,
                'fecha' => $request->fecha,
                'idHorario' => $request->idHorario,
                'observaciones' => $request->observaciones,
                'idServicio' => $request->idServicio,
                'estado' => 1
            ]);

            $pago = PagosPaciente::create([
                'idPaciente' => $request->idPaciente,
                'idServicio' => $request->idServicio,
                'precio' => 0,
                'observacion' => $request->observaciones,
                'metodoPago' => 0,
                'fecha_generacion' => $request->fecha,
                'estado' => 1
            ]);

            return back()->with('success', 'Cita Creada correctamente');
        }
        else
        {
            $validacion = Citas::where('idMedico', $request->idMedico)
            ->where('idPaciente', $request->idPaciente)
            ->where('fecha', $request->fecha)
            ->where('inicio', '>=', $request->inicio)
            ->where('fin', '<=', $request->fin)
            ->first();

            return back()->with('danger', "Ya el doctor: ". $medico->name ." ". $medico->last_name .", tiene una cita,
            el dia: ". $request->fecha . "En el horario: ". $validacion->inicio . "-" . $validacion->fin);
        }
    }

    public function update(Request $request)
    {
        Citas::updateOrCreate([
            'id' => $request->idCita,
        ], [
            'idMedico' => $request->idMedico,
            'idPaciente' => $request->idPaciente,
            'fecha' => $request->fecha,
            'idHorario' => $request->idHorario,
            'observaciones' => $request->observaciones,
            'idServicio' => $request->idServicio
        ]);

        return back()->with('success', 'Cita Actualizada correctamente');
    }

    public function getOcupados($idMedico, $fecha)
    {
       $citas = Citas::where('idMedico', $idMedico)->whereFecha($fecha)->get();
       $horarios = BloquesHorarios::all();

       $html = "<option>-- SELECCIONE --</option>";

       foreach($horarios as $horario)
       {
           $disabled = false;
            foreach($citas as $cita)
            {
                if($cita->idHorario == $horario->id)
                {
                    $disabled = true;
                }
            }

            if($disabled)
            {
                $html .="<option value='' disabled>$horario->horario</option>";
            }
            else{
                $html .= "<option value='$horario->id'>$horario->horario</option>";
            }
       }

       return $html;
    }
}
