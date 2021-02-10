@extends('base')

@section('title', 'Coevaluacion')

@section('content')

<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Ciclos
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        @if($ciclo != null)
        @foreach ($ciclo as $ciclo)
        <a class="dropdown-item" href="{{route('coevaluacion_lista.show', $id)}}">{{ $ciclo->ciclo }}</a>
        @endforeach
        @endif
    </div>
</div>
@if($ciclo != null)
@if($ciclo->ciclo_actual == $ci)
<div class="form-group">
    <input type="text" class="form-control pull-right" style="width:20%" id="search" placeholder="Buscar Docente...">
</div>
<div role="tabpanel" id="tabla" class="table-responsive">

    <table class="table table-striped jambo_table bulk_action" id="mytable">
        <thead>
            <tr class="headings">
                <th class="column-title">Apellidos</th>
                <th class="column-title">Nombre</th>
                <th class="column-title">Cedula</th>
                <th class="column-title">Correo Institucional</th>
                <th class="column-title">Status</th>
                <th class="column-title no-link last"><span class="nobr">Acciones</span>
                </th>
                <th class="bulk-actions" colspan="7">
                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($docentes as $docentes)
            <tr class="even pointer">
                <td class=" ">{{ $docentes->apellido }}</td>
                <td class=" ">{{ $docentes->name }}</td>
                <td class=" ">{{ $docentes->cedula }} </td>
                <td class=" ">{{ $docentes->email }}</td>
                <?php
                $ced = $docentes->cedula;
                ?>
                @if($docentes->status==1)
                <td class=" ">Ya Evaluado</td>
                <td class=" last">
                    <button id="" type="button" disabled="false" class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg">Evaluar</button>
                </td>
                @else
                <td class=" ">Por Evaluar</td>
                <td class=" ">
                    <button class="btncedula btn btn-info" data-id="{{ $docentes->cedula }}" data-toggle="modal" data-target=".bd-example-modal-lg">Evaluar</button>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

<!-- Large modal -->

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg border-dark">
        <div class="modal-content">
            <header class="title">
                <div class="col-title">
                    <h1>
                        <center> COEVALUACION DOCENTE
                    </h1>
                    <h4>
                        <center>Ciclo: {{ $ciclo->ciclo }}
                    </h4>
                </div>
            </header>

            <body>
                <form id="a" name="formulario" action="{{ route('coevaluacion_lista.update', $id) }}" class="form-label-left input_mask" method="POST">
                    @csrf
                    @method('put')


                    <section class="intro first">
                        </br>
                        <p>&nbsp;&nbsp;Buenos días,</p>
                        <p>&nbsp;&nbsp;por favor, dedique unos minutos de su tiempo para rellenar el siguiente cuestionario.</p>
                    </section>
                    <section class="intro first">
                        <H2>
                            <center> Tabla de Valoracion
                        </H2>
                    </section>
                    <div class=" ">
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">
                                    <th class="column-title">No cumple: 1</th>
                                    <th class="column-title">En proceso: 2</th>
                                    <th class="column-title">Satisfactorio: 3</th>
                                    <th class="column-title">Destacado: 1</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <?php
                    $cont = 1;
                    $radio = 1;
                    ?>
                    <table class="table table-bordered ">
                        <tbody>
                            <colgroup>
                                <colgroup span="1"></colgroup>
                            <tr class="table-active" style="text-align:center;">
                                <th rowspan="2">
                                    <h3>INDICADORES</h3>
                                </th>
                                <th colspan="4">OPCIONES</th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                            </tr>
                            @foreach ($preguntas as $preguntas)
                            <tr>
                                <td max-width: 100%>{{ $cont }} {{ $preguntas->titulo }}</td>
                                <td> <input id="{{ $radio }}" type="radio" class="hidden-inputs" name="{{ $preguntas->id }}" value="1" required /></td>
                                <td> <input id="{{ $radio }}" type="radio" class="hidden-inputs" name="{{ $preguntas->id }}" value="2" required /></td>
                                <td> <input id="{{ $radio }}" type="radio" class="hidden-inputs" name="{{ $preguntas->id }}" value="3" required /></td>
                                <td> <input id="{{ $radio }}" type="radio" class="hidden-inputs" name="{{ $preguntas->id }}" value="4" required /></td>
                            </tr>
                            <?php
                            $cont = $cont + 1;
                            $radio = $radio + 1;
                            ?>
                            @endforeach
                        </tbody>
                    </table>
                    <input type="hidden" name="cedula" id="cedula" />
                    <button class="btn btn-info" id="boton" style="float: right">Guardar</button>
                </form>
            </body>

        </div>
    </div>
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