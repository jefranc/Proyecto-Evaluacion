@extends('base')

@section('title', 'Asignacion Docente')

@section('content')
<div class="form-group">
    <h4>Lista de docentes coevaluadores</h4>
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
                <th colspan="2"></th>
                <th class="bulk-actions" colspan="7">
                    <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                </th>
            </tr>
        </thead>
        <tbody>

            <form action="{{ route('lista_mis_docentes.index') }}" method="GET">
                @foreach ($docentes as $docente)
                <tr class="even pointer">
                    <td class=" ">{{ $docente->apellido }}</td>
                    <td class=" ">{{ $docente->name }}</td>
                    <td class=" ">{{ $docente->cedula }}</td>
                    <td class=" ">{{ $docente->email }}</td>
                    <td class=" last">
                        <button class="btncedula btn btn-info" data-id="{{ $docente->cedula }}" value="Editar">Asignar Docente</button>
                    </td>
                </tr>
                @endforeach
                <input type="hidden" name="cedula" id="cedula" value="" />
            </form>
        </tbody>
    </table>
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
    });
    $('.btncedula').on('click', function() {
        var cedu = $(this).attr("data-id");
        console.log(cedu);
        document.getElementById("cedula").value = cedu;
    });
</script>
@endsection