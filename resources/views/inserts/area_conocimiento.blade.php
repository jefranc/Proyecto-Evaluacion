@extends('base')

@section('title', 'Manejo de Informacion')

@section('content')
<div class="x_panel">
    <div class="col-md-6 col-sm-6">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class=""></i>Areas del Conocimiento</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#area_conocimiento">
                    Agregar una nueva aréa
                </button>
                <div class="form-group">
                    <input type="text" class="form-control" style="width:70%" id="search_area" placeholder="Buscar...">
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="areas">
                        <thead>
                            <tr class="bg-info">
                                <th scope="col">#</th>
                                <th scope="col">Areas del conocimiento disponibles</th>
                                <th scope="col">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tipo = 'eliminar_area';
                            $num = 1;
                            ?>
                            <form action="{{ route('area.update',$tipo) }}" method="POST">
                                @csrf
                                @method('put')
                                @foreach($areas as $areas1)
                                <tr>
                                    <th scope="row">{{ $num }}</th>
                                    <td>{{ $areas1->area }}</td>
                                    <td><button class="btnarea btn-outline-danger" data-id="{{ $areas1->area }}">Eliminar Aréa</button></td>
                                </tr>
                                <?php
                                $num = $num + 1;
                                ?>
                                @endforeach
                                <input type="hidden" name="areain" id="areain" value="" />
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Area de Conocimiento -->
<div class="modal fade" id="area_conocimiento" tabindex="-1" role="dialog" aria-labelledby="area_conocimientoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="area_conocimientoLabel">Agregar una nueva aréa de conocimiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            $tipo = 'agregar_area';
            ?>
            <form action="{{ route('area.update', $tipo) }}" method="POST">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="area" placeholder="Ingrese un area de conocimiento" aria-label="Username" aria-describedby="basic-addon1">
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
        $("#search_area").keyup(function() {
            _this = this;
            // Show only matching TR, hide rest of them
            $.each($("#areas tbody tr"), function() {
                if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();
            });
        });
    });
    $('.btnarea').on('click', function() {
        var area = $(this).attr("data-id");
        console.log(area);
        document.getElementById("areain").value = area;
    });
</script>
ciclo_eliminar
@endsection