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
        <b>Diagnostico:</b> {{$recetas->diagnostico->diagostico}} <br>
        <b>Tratamiento:</b> {{$recetas->diagnostico->tratamiento}}
    </div>

        <table border="1" width="100%" style="margin-top: 30px">
            <thead>
                <tr>
                    <td colspan="5" style="text-align: center; font-size: 20px"><b>DETALLE DE MEDICAMENTOS</b> </td>
                </tr>
                <tr style="border: 1px solid">
                    <th>Medicamento</th>
                    <th>Presentacion</th>
                    <th>Dosis</th>
                    <th>Duracion</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody id="recetasReceta">
                @foreach ($recetas->diagnostico->recetas as $receta)
                    <tr>
                        <td style="text-align: center">{{ $receta->medicamento }}</td>
                        <td style="text-align: center">{{ $receta->presentacion }}</td>
                        <td style="text-align: center">{{ $receta->dosis }}</td>
                        <td style="text-align: center">{{ $receta->duracion }}</td>
                        <td style="text-align: center">{{ $receta->cantidad }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>

</body>

</html>
