<!DOCTYPE html>
<html lang="en">

<head>
    <title>PDF</title>
</head>

<body>
    <table>
        <tr>
            <td width="80%">
                <h1>{{ $empresa->nombre }}</h1>
                <span>
                    RUC: {{ $empresa->documento }} <br>
                    {{ $empresa->direccion }} <br>
                    {{ $empresa->telefono }} <br>
                    {{ $empresa->correo }} <br>
                    WEB: {{ $empresa->web }} <br>
                </span>
            </td>
            <td width="20%"><img src="{{$ruta}}" style="width: 100%" alt=""></td>
        </tr>
    </table>

    <div style="margin-top: 30px">
        <b>Paciente: ({{$recetas->paciente->document}}) </b>{{$recetas->paciente->name}} {{$recetas->paciente->last_name}} <br>
        <b>Medico: ({{$recetas->medico->document}}) </b>{{$recetas->medico->name}} {{$recetas->medico->last_name}} <br>
        <b>Especialidad: </b> {{$recetas->servicio->servicio}}
    </div>


    <table border="1" style="width: 100%; margin-top: 20px">
        <tr>
            <td style="font-size: 20px; text-align: center; font-weight: 700">Motivo de la visita</td>
        </tr>
        <tr>
            <td style="padding: 10px">{{$recetas->diagnostico->motivo}}</td>
        </tr>

        <tr>
            <td style="font-size: 20px; text-align: center; font-weight: 700">Antecedentes</td>
        </tr>
        <tr>
            <td style="padding: 10px">{{$recetas->diagnostico->antecedentes}}</td>
        </tr>

        <tr>
            <td style="font-size: 20px; text-align: center; font-weight: 700">Tiempo de la Enfermedad</td>
        </tr>
        <tr>
            <td style="padding: 10px">{{$recetas->diagnostico->tiempo_enfermedad}}</td>
        </tr>

        <tr>
            <td style="font-size: 20px; text-align: center; font-weight: 700">Alergias</td>
        </tr>
        <tr>
            <td style="padding: 10px">{{$recetas->diagnostico->alergias}}</td>
        </tr>

        <tr>
            <td style="font-size: 20px; text-align: center; font-weight: 700">Intervenciones</td>
        </tr>
        <tr>
            <td style="padding: 10px">{{$recetas->diagnostico->intervenciones}}</td>
        </tr>

        <tr>
            <td style="font-size: 20px; text-align: center; font-weight: 700">Examen Fisico</td>
        </tr>
        <tr>
            <td style="padding: 10px">{{$recetas->diagnostico->examen}}</td>
        </tr>

        <tr>
            <td style="font-size: 20px; text-align: center; font-weight: 700">Diagnostico
                (
                    @if($recetas->diagnostico->tipo_diagnostico == 1)
                    PRESUNTIVO
                    @elseif($recetas->diagnostico->tipo_diagnostico == 2)
                    DEFINITIVO
                    @else
                    REPETIDO
                    @endif
                )
            </td>
        </tr>
        <tr>
            <td style="padding: 10px">{{$recetas->diagnostico->diagostico}}</td>
        </tr>

        <tr>
            <td style="font-size: 20px; text-align: center; font-weight: 700">Tratamiento</td>
        </tr>
        <tr>
            <td style="padding: 10px">{{$recetas->diagnostico->tratamiento}}</td>
        </tr>

        <tr>
            <td style="font-size: 20px; text-align: center; font-weight: 700">Vacunas</td>
        </tr>
        <tr>
            <td style="padding: 10px">{{$recetas->diagnostico->vacunas}}</td>
        </tr>


    </table>

</body>

</html>
