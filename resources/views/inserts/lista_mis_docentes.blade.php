@extends('base')

@section('title', 'Lista de Docentes')

@section('content')
<div class="form-group">
    <h4>Lista de docentes asignados a: {{ $user_coe->apellido }} {{ $user_coe->name }}</h4>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Añadir Docente</button>
    <input type="text" class="form-control pull-right" style="width:20%" id="search" placeholder="Buscar Docente...">
</div>

<div class="table-responsive">
    <table class="table table-bordered" id="mytable">
        <thead>
            <tr class="bg-info">
                <th scope="col">#</th>
                <th scope="col">Apellido</th>
                <th scope="col">Nombre</th>
                <th scope="col">Cedula</th>
                <th scope="col">Correo Institucional</th>
                <th colspan="1"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $tipo = 'eliminar_docente';
            $num = 1;
            ?>
            <form action="{{ route('lista_mis_docentes.update',$tipo) }}" method="POST">
                @csrf
                @method('put')
                @foreach($docentes as $docente)
                <tr>
                    @if($docente->evaluador1 == $cedula)
                    <th scope="row">{{ $num }}</th>
                    <td class=" ">{{ $docente->apellido }}</td>
                    <td class=" ">{{ $docente->name }}</td>
                    <td class=" ">{{ $docente->cedula }}</td>
                    <td class=" ">{{ $docente->email }}</td>
                    <td class=" last">
                        <center><button class="btncedula btn-outline-danger" data-id="{{ $docente->cedula }}" value="Editar">Eliminar Asignación</button>
                    </td>
                    <?php
                    $num = $num + 1;
                    ?>
                    @elseif($docente->evaluador2 == $cedula)
                    <th scope="row">{{ $num }}</th>
                    <td class=" ">{{ $docente->apellido }}</td>
                    <td class=" ">{{ $docente->name }}</td>
                    <td class=" ">{{ $docente->cedula }}</td>
                    <td class=" ">{{ $docente->email }}</td>
                    <td class=" last">
                        <center><button class="btncedula btn-outline-danger" data-id="{{ $docente->cedula }}" value="Editar">Eliminar</button>
                    </td>
                    <?php
                    $num = $num + 1;
                    ?>
                    @elseif($docente->evaluador3 == $cedula)
                    <th scope="row">{{ $num }}</th>
                    <td class=" ">{{ $docente->apellido }}</td>
                    <td class=" ">{{ $docente->name }}</td>
                    <td class=" ">{{ $docente->cedula }}</td>
                    <td class=" ">{{ $docente->email }}</td>
                    <td class=" last">
                        <center><button class="btncedula btn-outline-danger" data-id="{{ $docente->cedula }}" value="Editar">Eliminar</button>
                    </td>
                    <?php
                    $num = $num + 1;
                    ?>
                    @elseif($docente->evaluador4 == $cedula)
                    <th scope="row">{{ $num }}</th>
                    <td class=" ">{{ $docente->apellido }}</td>
                    <td class=" ">{{ $docente->name }}</td>
                    <td class=" ">{{ $docente->cedula }}</td>
                    <td class=" ">{{ $docente->email }}</td>
                    <td class=" last">
                        <center><button class="btncedula btn-outline-danger" data-id="{{ $docente->cedula }}" value="Editar">Eliminar</button>
                    </td>
                    <?php
                    $num = $num + 1;
                    ?>
                    @elseif($docente->evaluador5 == $cedula)
                    <th scope="row">{{ $num }}</th>
                    <td class=" ">{{ $docente->apellido }}</td>
                    <td class=" ">{{ $docente->name }}</td>
                    <td class=" ">{{ $docente->cedula }}</td>
                    <td class=" ">{{ $docente->email }}</td>
                    <td class=" last">
                        <center><button class="btncedula btn-outline-danger" data-id="{{ $docente->cedula }}" value="Editar">Eliminar</button>
                    </td>
                    <?php
                    $num = $num + 1;
                    ?>
                    @endif
                </tr>
                @endforeach
                <input type="hidden" name="cedula2" id="cedula" value="" />
                <input type="hidden" name="cedula" id="cedul" value="{{ $cedula }}" />
            </form>
        </tbody>
    </table>
</div>

<!-- Modal añadir Docente -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Lista de Docentes </h5>
                <div>
                    <input type="text" class="form-control pull-right" style="width:80%" id="search2" placeholder="Buscar Docente...">
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            $tipo = 'añadir_docente';
            $num = 1;
            $cont = 0;
            ?>
            <form action="{{ route('lista_mis_docentes.update',$tipo) }}" method="POST">
                @csrf
                @method('put')
                <div class="modal-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="mytable2">
                            <thead>
                                <tr class="bg-info">
                                    <th scope="col">#</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Cedula</th>
                                    <th scope="col">Seleccionar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($docentes as $docente)
                                <tr>
                                    @if($docente->evaluador1 == $cedula)

                                    @elseif($docente->evaluador2 == $cedula)

                                    @elseif($docente->evaluador3 == $cedula)

                                    @elseif($docente->evaluador4 == $cedula)

                                    @elseif($docente->evaluador5 == $cedula)

                                    @else
                                    <th scope="row">{{ $num }}</th>
                                    <td class=" ">{{ $docente->apellido }}</td>
                                    <td class=" ">{{ $docente->name }}</td>
                                    <td class=" ">{{ $docente->cedula }}</td>
                                    <td class=" last">
                                        <center><input id="rol" type="checkbox" name="cedulass[]" class="flat" value="{{ $docente->cedula }}">
                                    </td>
                                    @endif
                                </tr>
                                <?php
                                $num = $num + 1;
                                ?>
                                @endforeach

                            </tbody>
                            <?php
                            $num = $num - 1;
                            ?>
                            <input type="hidden" name="cedula" id="cedu" value="{{ $cedula }}" />
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Añadir</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
        $("#search2").keyup(function() {
            _this = this;
            // Show only matching TR, hide rest of them
            $.each($("#mytable2 tbody tr"), function() {
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