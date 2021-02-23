@extends('base')

@section('title', 'Manejo de Informacion')

@section('content')
<div class="x_panel">
    <div class="col-md-6 col-sm-6">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class=""></i>Ciclos</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="x-panel">
                    <h4>Ciclo Activo: {{ $ciclo_actual }}</h4>
                    <div class="pull-right">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ciclo_actu">
                            Asignar ciclo actual
                        </button>
                    </div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ciclos">
                        Agregar un nuevo ciclo
                    </button>
                </div>
                <div class="table" style="width:50%">
                    <table class="table table-bordered" id="areas">
                        <thead>
                            <tr class="bg-info">
                                <th scope="col">Tabla de Ciclos</th>
                                <th scope="col">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tipo = 'eliminar_ciclo';
                            $num = 1;
                            ?>
                            <form action="{{ route('ciclos.update',$tipo) }}" method="POST">
                                @csrf
                                @method('put')
                                @foreach($ciclos as $ciclo)
                                <tr>
                                    <td>{{ $ciclo->ciclo }}</td>
                                    <td><button class="btnciclo btn-outline-danger" data-id="{{ $ciclo->ciclo }}">Eliminar Ciclo</button></td>
                                </tr>
                                @endforeach
                                <input type="hidden" name="ciclo_eliminar" id="ciclo_eliminar" value="" />
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ciclos -->
<div class="modal fade" id="ciclos" tabindex="-1" role="dialog" aria-labelledby="ciclosLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ciclosLabel">Agregar un nuevo ciclo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            $tipo = 'nuevo_ciclo';
            ?>
            <form action="{{ route('ciclos.update',$tipo) }}" method="POST">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="ci" placeholder="Ingrese un ciclo" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ciclos actual-->
<div class="modal fade" id="ciclo_actu" tabindex="-1" role="dialog" aria-labelledby="ciclo_actuLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ciclo_actuLabel">Agregar un nuevo ciclo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            $tipo = 'ciclo_actual';
            ?>
            <form action="{{ route('ciclos.update',$tipo) }}" method="POST">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Ciclos Disponibles</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="cic" required>
                            @foreach($ciclos as $ciclo)
                            <option value="{{ $ciclo->ciclo }}">{{ $ciclo->ciclo }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary">Guardar</button>
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
        
    });
    $('.btnciclo').on('click', function() {
        var ciclo = $(this).attr("data-id");
        console.log(ciclo);
        document.getElementById("ciclo_eliminar").value = ciclo;
    });
</script>
ciclo_eliminar
@endsection