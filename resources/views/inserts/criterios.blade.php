@extends('base')

@section('title', 'Manejo de Informacion')

@section('content')
<div class="x_panel">
    <div class="col-md-4 col-sm-6">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class=""></i>Criterios de Evaluación</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table" style="width:50%">
                    <table class="table table-bordered" id="areas">
                        <thead>
                            <tr class="bg-info">
                                <th scope="col">Tabla de Criterios</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $tipo = 'eliminar_ciclo';
                            $num = 1;
                            ?>
                            @foreach($criterios as $criterio)
                            <tr>
                                <td>{{ $criterio->nombre }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        console.log("listo!");

    });
</script>
@endsection