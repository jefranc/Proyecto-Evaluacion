@extends('base')

@section('title', 'Lista de Docentes')

@section('content')
<div class="x_panel">
    <table class="table table-bordered rwd_auto">
        <tbody>
            <colgroup>
                <colgroup span="1"></colgroup>
            <tr class="table-active" style="text-align:center;">

                <th>
                    <h3> Preguntas de Coevaluación</h3>
                </th>
            </tr>
            <tr>
                <td>
                    <h5>
                        <center>Pedagógica
                    </h5>
                </td>
            </tr>
            <?php
            $cont = 1;
            ?>
            @foreach ($preguntas_peda as $preguntas_ped)
            <tr>
                <td max-width: 100%> {{ $cont }}:) {{ $preguntas_ped->titulo }} </td>
            </tr>
            <?php
            $cont = $cont + 1;
            ?>
            @endforeach

            <tr>
                <td>
                    <h5>
                        <center>Didáctica
                    </h5>
                </td>
            </tr>
            @foreach ($preguntas_dida as $preguntas_did)
            <tr>
                <td max-width: 100%> {{ $cont }}:) {{ $preguntas_did->titulo }} </td>
            </tr>
            <?php
            $cont = $cont + 1;
            ?>
            @endforeach

            <tr>
                <td>
                    <h5>
                        <center>TICS
                    </h5>
                </td>
            </tr>
            @foreach ($preguntas_tics as $preguntas_tic)
            <tr>
                <td max-width: 100%> {{ $cont }}:) {{ $preguntas_tic->titulo }} </td>
            </tr>
            <?php
            $cont = $cont + 1;
            ?>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        console.log("listo!");

    });
</script>
@endsection