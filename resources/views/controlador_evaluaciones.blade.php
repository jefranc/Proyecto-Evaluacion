@extends('base')

@section('title', 'Lista de Docentes')

@section('content')
<!-- Tablas Todos -->
@if($tipo == 'todos')
<?php
$tipo2 = 'auto';
$tipo3 = 'coe';
?>
<header class="title">
    <div class="col-title">
        <h1>
            <center> Seguimiento de Evaluaciones
        </h1>
    </div>
</header>
<div class="form-group">
    <form action="{{ route('controlador_evaluaciones.update', $tipo2) }}" method="POST">
        @csrf
        @method('put')
        <button class="btncedula btn btn-info" " value=" Editar">Docentes que faltan por autoevaluarse</button>
    </form>
    <form action="{{ route('controlador_evaluaciones.update', $tipo3) }}" method="POST">
        @csrf
        @method('put')
        <button class="btncedula btn btn-info" " value=" Editar">Docentes que faltan por coevaluar</button>
    </form>
</div>

<!-- Tablas Falta por autoevaluar -->
@elseif($tipo == 'auto')
<?php
$tipo2 = 'auto';
$tipo3 = 'coe';
?>
<header class="title">
    <div class="col-title">
        <h1>
            <center> Seguimiento de Evaluaciones
        </h1>
        <h3>
            <center> Listado de autoevaluación
        </h3>
    </div>
</header>
<div class="form-group">
    <form action="{{ route('controlador_evaluaciones.update', $tipo2) }}" method="POST">
        @csrf
        @method('put')
        <button class="btncedula btn btn-info" " value=" Editar">Docentes que faltan por autoevaluarse</button>
    </form>
    <form action="{{ route('controlador_evaluaciones.update', $tipo3) }}" method="POST">
        @csrf
        @method('put')
        <button class="btncedula btn btn-info" " value=" Editar">Docentes que faltan por coevaluar</button>
    </form>
    <input type="text" class="form-control pull-right" style="width:20%" id="search" placeholder="Buscar Docente...">
</div>
<div class="table-responsive">
    <table class="table table-striped jambo_table bulk_action" id="mytable">
        <thead>
            <tr class="headings">
                <th class="column-title">Apellido</th>
                <th class="column-title">Nombre</th>
                <th class="column-title">Cedula</th>
                <th class="column-title">Correo Institucional</th>
                <th class="column-title">Estado</th>
            </tr>
        </thead>
        <tbody>
            <form action="{{ route('editar_usuario.index') }}" method="GET">
                @foreach ($docentes as $docente)
                <tr class="even pointer">
                    @if($docente->auto == '0')
                    <td class=" ">{{ $docente->apellido }}</td>
                    <td class=" ">{{ $docente->name }}</td>
                    <td class=" ">{{ $docente->cedula }}</td>
                    <td class=" ">{{ $docente->email }}</td>
                    <td class=" ">Falta Autoevaluarse</td>
                    @else
                    <td class=" ">{{ $docente->apellido }}</td>
                    <td class=" ">{{ $docente->name }}</td>
                    <td class=" ">{{ $docente->cedula }}</td>
                    <td class=" ">{{ $docente->email }}</td>
                    <td class=" ">Autoevaluado</td>
                    @endif
                </tr>
                @endforeach
            </form>
        </tbody>
    </table>
</div>
<!-- Tablas Falta por coevaluar -->
@elseif($tipo == 'coe')
<?php
$tipo2 = 'auto';
$tipo3 = 'coe';
?>
<header class="title">
    <div class="col-title">
        <h1>
            <center> Seguimiento de Evaluaciones
        </h1>
        <h3>
            <center> Listado de coevaluación de pares academicos
        </h3>
    </div>
</header>
<div class="form-group">
    <form action="{{ route('controlador_evaluaciones.update', $tipo2) }}" method="POST">
        @csrf
        @method('put')
        <button class="btncedula btn btn-info" " value=" Editar">Docentes que faltan por autoevaluarse</button>
    </form>
    <form action="{{ route('controlador_evaluaciones.update', $tipo3) }}" method="POST">
        @csrf
        @method('put')
        <button class="btncedula btn btn-info" " value=" Editar">Docentes que faltan por coevaluar</button>
    </form>
    <input type="text" class="form-control pull-right" style="width:20%" id="search" placeholder="Buscar Docente...">
</div>
<div class="table-responsive">
    <table class="table table-striped jambo_table bulk_action" id="mytable">
        <thead>
            <tr class="headings">
                <th class="column-title">Apellido</th>
                <th class="column-title">Nombre</th>
                <th class="column-title">Cedula</th>
                <th class="column-title">Correo Institucional</th>
                <th class="column-title">Coevaluador</th>
                <th class="column-title">Estado</th>
            </tr>
        </thead>
        <tbody>
            <form action="{{ route('editar_usuario.index') }}" method="GET">
                @foreach ($compro as $compr)
                <tr class="even pointer">
                    @if($compr->estado == 0)
                    @foreach($docentes as $docente)
                    @if($compr->evaluado == $docente->cedula)
                    <td class=" ">{{ $docente->apellido }}</td>
                    <td class=" ">{{ $docente->name }}</td>
                    <td class=" ">{{ $docente->cedula }}</td>
                    <td class=" ">{{ $docente->email }}</td>
                    @foreach($docentes as $docent)
                    @if($compr->ci_coevaluador_id == $docent->cedula)
                    <td class=" ">{{ $docent->apellido }} {{ $docent->name }}</td>
                    <td class=" ">Falta Coevaluar</td>
                    @endif
                    @endforeach
                    @endif
                    @endforeach
                    @else
                    <td class=" ">{{ $docente->apellido }}</td>
                    <td class=" ">{{ $docente->name }}</td>
                    <td class=" ">{{ $docente->cedula }}</td>
                    <td class=" ">{{ $docente->email }}</td>
                    @foreach($docentes as $docent)
                    @if($compr->ci_coevaluador_id == $docent->cedula)
                    <td class=" ">{{ $docent->apellido }} {{ $docent->name }}</td>
                    <td class=" ">Coevaluado</td>
                    @endif
                    @endforeach
                    @endif
                </tr>
                @endforeach
            </form>
        </tbody>
    </table>
</div>
@endif
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        console.log("listo!");
        $("#search").keyup(function() {
            _this = this;
            // Show only matching TR, hide rest of them
            $.each($("#mytable tbody tr"), function() {
                if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();
            });
        });
    });
    $('.btncedula').on('click', function() {
        var cedu = $(this).attr("data-id");
        console.log(cedu);
        document.getElementById("cedula").value = cedu;
    });
</script>
@endsection