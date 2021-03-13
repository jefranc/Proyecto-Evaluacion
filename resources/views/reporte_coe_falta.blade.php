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
            <h3>Reporte de Coevaluación</h3>
    </div>
    <div>
        <h5>Lista de docentes coevaluados</h5>
    </div>
    <div class="x_panel">
        <div class="table" style="width:100%">
            <table class="table table-bordered" id="areas">
                <thead>
                    <tr class="bg-info" style="text-align:center;">
                        <th scope="col">#</th>
                        <th scope="col">Docente</th>
                        <th scope="col">Coevaluador</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cont = 1;
                    ?>
                    @foreach ($compro as $compr)
                    @foreach($docentes as $docente)
                    @if($compr->evaluado == $docente->cedula)
                    @if($compr->estado == 0)
                    <tr>
                        <td max-width: 100% style="text-align:center;">{{ $cont }}</td>
                        <td max-width: 100% style="text-align:center;">{{ $docente->apellido }} {{ $docente->name }}</td>
                        <?php
                        $cont = $cont + 1;
                        ?>
                        @foreach($docentes as $docent)
                        @if($compr->ci_coevaluador_id == $docent->cedula)
                        <td max-width: 100% style="text-align:center;">{{ $docent->apellido }} {{ $docent->name }}</td>
                        @endif
                        @endforeach
                    </tr>
                    @endif
                    @endif
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>


</html>