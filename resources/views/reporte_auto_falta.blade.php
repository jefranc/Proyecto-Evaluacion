<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Prueba de Libreria</title>
</head>

<body>
    <div class="pull-right">
        <center>
            <h1>Evaluación Docente</h1>
            <h2>Facultad de Ciencias Matemáticas y Físicas</h2>
    </div>
    <div>
        <center>
            <h3>Reporte de Autoevaluación</h3>
    </div>
    <div>
        <h5>Lista de docentes que faltan autoevaluarse</h5>
    </div>
    <div class="x_panel">
        <div class="table" style="width:100%">
            <table class="table table-bordered" id="areas">
                <thead>
                    <tr class="bg-info" style="text-align:center;">
                        <th scope="col">#</th>
                        <th scope="col">Docente</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cont = 1;
                    ?>
                    @foreach($user as $use)
                    @if($use->name == 'admin')
                    <?php
                    $cont = $cont;
                    ?>
                    @elseif($use->auto == 0)
                    <tr>
                        <td max-width: 50 style="text-align:center;"%>{{ $cont }}</td>
                        <td max-width: 100% style="text-align:center;">{{ $use->apellido }} {{ $use->name }}</td>
                    </tr>
                    <?php
                    $cont = $cont + 1;
                    ?>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>


</html>