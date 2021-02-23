@extends('base')

@section('title', 'Manejo de Informacion')

@section('content')
<div class="x_panel">
    <div class="col-md-6 col-sm-6  ">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class=""></i>Materias</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#materia">
                    Agregar una nueva materia
                </button>
                <div class="form-group">
                    <input type="text" class="form-control" style="width:50%" id="search_mate" placeholder="Buscar...">
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="materias">
                        <thead>
                            <tr class="bg-info">
                                <th scope="col">#</th>
                                <th scope="col">Materias disponibles</th>
                                <th scope="col">Aréa del Conocimiento</th>
                                <th scope="col">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tipo = 'eliminar_mate';
                            $num = 1;
                            ?>
                            <form action="{{ route('materias.update',$tipo) }}" method="POST">
                                @csrf
                                @method('put')
                                @foreach($materias as $materias1)
                                <tr>
                                    <th scope="row">{{ $num }}</th>
                                    <td>{{ $materias1->materia }}</td>
                                    <td>{{ $materias1->area }}</td>
                                    <td><button class="btnmate btn-outline-danger" data-id="{{ $materias1->materia }}">Eliminar Materia</button></td>
                                </tr>
                                <?php
                                $num = $num + 1;
                                ?>
                                @endforeach
                                <input type="hidden" name="matein" id="matein" value="" />
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Materias-->
<div class="modal fade" id="materia" tabindex="-1" role="dialog" aria-labelledby="materiaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="materiaLabel">Agregar una nueva materia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            $tipo = 'agregar_materia';
            ?>
            <form action="{{ route('materias.update', $tipo) }}" method="POST">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="mate" placeholder="Ingrese una materia" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Area de Conocimiento</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="area" required>
                            @foreach($areas as $area)
                            <option value="{{ $area->area }}">{{ $area->area }}</option>
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
    $("#search_mate").keyup(function() {
        _this = this;
        // Show only matching TR, hide rest of them
        $.each($("#materias tbody tr"), function() {
            if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                $(this).hide();
            else
                $(this).show();
        });
    });
    $('.btnmate').on('click', function() {
        var mate = $(this).attr("data-id");
        console.log(mate);
        document.getElementById("matein").value = mate;
    });
</script>
ciclo_eliminar
@endsection