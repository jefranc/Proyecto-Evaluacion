<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Prueba de Libreria</title>
</head>

<body>
    <div class="pull-right">
        <center>
            <h1>Evaluacion Docente</h1>
    </div>
    <div>
        <h5>Docente: {{ $user->apellido }} {{ $user->name }}</h5>
        <h5>Ciclo: {{ $ciclos }}</h5>
    </div>
    <div>
        <center>
            <h2>Autoevaluación</h2>
    </div>
    <div>
        <h5>Nota total de autoevaluación: {{ $total_auto }}/100</h5>

    </div>
    <div class="x_panel">
        <div class="table" style="width:100%">
            <table class="table table-bordered" id="areas">
                <thead>
                    <tr class="bg-info" style="text-align:center;">
                        <th scope="col" colspan="2">Pedagogía</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cont = 1;
                    ?>
                    @foreach($pedagogico as $pedagogic)
                    <tr>
                        <td max-width: 100%>Pregunta {{ $cont }}</td>
                        <td max-width: 100% style="text-align:center;">{{ $pedagogic }} </td>
                    </tr>
                    <?php
                    $cont = $cont + 1;
                    ?>
                    @endforeach
                    <tr>
                        <td max-width: 100%>
                            <h4>Total</h4>
                        </td>
                        <td max-width: 100% style="text-align:center;">
                            <h4>{{ $resultado_auto_peda }}/100 </h4>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table" style="width:100%">
            <table class="table table-bordered" id="areas">
                <thead>
                    <tr class="bg-info" style="text-align:center;">
                        <th scope="col" colspan="2">Didáctica</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cont = 1;
                    ?>
                    @foreach($didactica as $didactic)
                    <tr>
                        <td max-width: 100%>Pregunta {{ $cont }}</td>
                        <td max-width: 100% style="text-align:center;">{{ $didactic }} </td>
                    </tr>
                    <?php
                    $cont = $cont + 1;
                    ?>
                    @endforeach
                    <tr>
                        <td max-width: 100%>
                            <h4>Total</h4>
                        </td>
                        <td max-width: 100% style="text-align:center;">
                            <h4>{{ $resultado_auto_dida }}/100 </h4>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table" style="width:100%">
            <table class="table table-bordered" id="areas">
                <thead>
                    <tr class="bg-info" style="text-align:center;">
                        <th scope="col" colspan="2">TICS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cont = 1;
                    ?>
                    @foreach($tics as $tic)
                    <tr>
                        <td max-width: 100%>Pregunta {{ $cont }}</td>
                        <td max-width: 100% style="text-align:center;">{{ $tic }} </td>
                    </tr>
                    <?php
                    $cont = $cont + 1;
                    ?>
                    @endforeach
                    <tr>
                        <td max-width: 100%>
                            <h4>Total</h4>
                        </td>
                        <td max-width: 100% style="text-align:center;">
                            <h4>{{ $resultado_auto_tic }}/100 </h4>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div style="page-break-after: always"></div>
    @if($docente_coe_ape != null)
    <div>
        <center>
            <h2>Coevaluación</h2>
    </div>
    <div>
        <h5>Docente Coevaluador: {{ $docente_coe_ape }} {{ $docente_coe_na }}</h5>
        <h5>Materia: {{ $mate }}</h5>
        <h5>Nota total de Coevaluación: {{ $total_coe }}/100</h5>

    </div>
    <div class="x_panel">
        <div class="table" style="width:100%">
            <table class="table table-bordered" id="areas">
                <thead>
                    <tr class="bg-info" style="text-align:center;">
                        <th scope="col" colspan="2">Pedagogía</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cont = 1;
                    ?>
                    @foreach($pedagogico_coe as $pedagogico_co)
                    <tr>
                        <td max-width: 100%>Pregunta {{ $cont }}</td>
                        <td max-width: 100% style="text-align:center;">{{ $pedagogico_co }} </td>
                    </tr>
                    <?php
                    $cont = $cont + 1;
                    ?>
                    @endforeach
                    <tr>
                        <td max-width: 100%>
                            <h4>Total</h4>
                        </td>
                        <td max-width: 100% style="text-align:center;">
                            <h4>{{ $resultado_coe_peda }}/100 </h4>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table" style="width:100%">
            <table class="table table-bordered" id="areas">
                <thead>
                    <tr class="bg-info" style="text-align:center;">
                        <th scope="col" colspan="2">Didáctica</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cont = 1;
                    ?>
                    @foreach($didactica_coe as $didactica_co)
                    <tr>
                        <td max-width: 100%>Pregunta {{ $cont }}</td>
                        <td max-width: 100% style="text-align:center;">{{ $didactica_co }} </td>
                    </tr>
                    <?php
                    $cont = $cont + 1;
                    ?>
                    @endforeach
                    <tr>
                        <td max-width: 100%>
                            <h4>Total</h4>
                        </td>
                        <td max-width: 100% style="text-align:center;">
                            <h4>{{ $resultado_coe_dida }}/100 </h4>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table" style="width:100%">
            <table class="table table-bordered" id="areas">
                <thead>
                    <tr class="bg-info" style="text-align:center;">
                        <th scope="col" colspan="2">TICS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cont = 1;
                    ?>
                    @foreach($tics_coe as $tics_co)
                    <tr>
                        <td max-width: 100%>Pregunta {{ $cont }}</td>
                        <td max-width: 100% style="text-align:center;">{{ $tics_co }} </td>
                    </tr>
                    <?php
                    $cont = $cont + 1;
                    ?>
                    @endforeach
                    <tr>
                        <td max-width: 100%>
                            <h4>Total</h4>
                        </td>
                        <td max-width: 100% style="text-align:center;">
                            <h4>{{ $resultado_coe_tic }}/100 </h4>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endif
</body>


</html>