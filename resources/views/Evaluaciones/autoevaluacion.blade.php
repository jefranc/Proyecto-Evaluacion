@extends('base')
@section('title', 'Evaluacion')
@section('content')

@if($auto == 0)
@if($ciclo != null)
<div class="">
    <header class="title">
        <div class="col-title">
            <h1>
                <center> AUTOEVALUACION DOCENTE
            </h1>
            <h4>
                <center>Ciclo: {{ $ciclo->ciclo }}
            </h4>
        </div>
    </header>

    <body>
        <form id="a" action="{{ route('autoevaluacion.update', $cedula) }}" class="form-label-left input_mask" method="POST">
            @csrf
            @method('put')

            <section class="intro first">
                <p>Buenos días,</p>
                <p>Por favor, dedique unos minutos de su tiempo para rellenar el siguiente cuestionario.</p>
            </section>
            <section class="intro first">
                <H2>
                    <center> Tabla de Valoración
                </H2>
            </section>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
                        <th class="column-title">No cumple: 1</th>
                        <th class="column-title">En proceso: 2</th>
                        <th class="column-title">Satisfactorio: 3</th>
                        <th class="column-title">Destacado: 4</th>
                    </tr>
                </thead>
            </table>
            <?php
            $cont = 1;
            $radio = 1;
            ?>
            <table class="table table-bordered rwd_auto">
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

                    <tr>
                        <td colspan="5">
                            <h5>
                                <center><b>Pedagógica</b>
                            </h5>
                        </td>
                    </tr>
                    @foreach ($preguntas_peda as $preguntas_ped)
                    <tr>
                        <td max-width: 100%> {{ $cont }}:) {{ $preguntas_ped->titulo }} </td>
                        <td> <input id="{{ $radio }}" type="radio" class="hidden-inputs" name="{{ $preguntas_ped->id }}" value="1" required /></td>
                        <td> <input id="{{ $radio }}" type="radio" class="hidden-inputs" name="{{ $preguntas_ped->id }}" value="2" required /></td>
                        <td> <input id="{{ $radio }}" type="radio" class="hidden-inputs" name="{{ $preguntas_ped->id }}" value="3" required /></td>
                        <td> <input id="{{ $radio }}" type="radio" class="hidden-inputs" name="{{ $preguntas_ped->id }}" value="4" required /></td>
                    </tr>
                    <?php
                    $cont = $cont + 1;
                    $radio = $radio + 1;
                    ?>
                    @endforeach

                    <tr>
                        <td colspan="5">
                            <h5>
                                <center><b>Didáctica</b>
                            </h5>
                        </td>
                    </tr>
                    @foreach ($preguntas_dida as $preguntas_did)
                    <tr>
                        <td max-width: 100%> {{ $cont }}:) {{ $preguntas_did->titulo }} </td>
                        <td> <input id="{{ $radio }}" type="radio" class="hidden-inputs" name="{{ $preguntas_did->id }}" value="1" required /></td>
                        <td> <input id="{{ $radio }}" type="radio" class="hidden-inputs" name="{{ $preguntas_did->id }}" value="2" required /></td>
                        <td> <input id="{{ $radio }}" type="radio" class="hidden-inputs" name="{{ $preguntas_did->id }}" value="3" required /></td>
                        <td> <input id="{{ $radio }}" type="radio" class="hidden-inputs" name="{{ $preguntas_did->id }}" value="4" required /></td>
                    </tr>
                    <?php
                    $cont = $cont + 1;
                    $radio = $radio + 1;
                    ?>
                    @endforeach

                    <tr>
                        <td colspan="5">
                            <h5>
                                <center><b>TICS</b>
                            </h5>
                        </td>
                    </tr>
                    @foreach ($preguntas_tics as $preguntas_tic)
                    <tr>
                        <td max-width: 100%> {{ $cont }}:) {{ $preguntas_tic->titulo }} </td>
                        <td> <input id="{{ $radio }}" type="radio" class="hidden-inputs" name="{{ $preguntas_tic->id }}" value="1" required /></td>
                        <td> <input id="{{ $radio }}" type="radio" class="hidden-inputs" name="{{ $preguntas_tic->id }}" value="2" required /></td>
                        <td> <input id="{{ $radio }}" type="radio" class="hidden-inputs" name="{{ $preguntas_tic->id }}" value="3" required /></td>
                        <td> <input id="{{ $radio }}" type="radio" class="hidden-inputs" name="{{ $preguntas_tic->id }}" value="4" required /></td>
                    </tr>
                    <?php
                    $cont = $cont + 1;
                    $radio = $radio + 1;
                    ?>
                    @endforeach
                </tbody>
            </table>
            <input type="hidden" name="cedula" id="cedula" value="{{ $cedula }}" />
            <button id="open" class="btn btn-info" style="float: right">Guardar</button>
        </form>
    </body>
</div>
@else
<div class="x_panel">
    <div class="x_title">
        <h3>Prueba no disponible</h3>
    </div>
</div>
@endif
@else
<div class="x_panel">
    <div class="x_title">
        <h3>Ya has realizado la autoevaluación</h3>
    </div>
</div>
@endif


@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        console.log("liasto!");
    });
</script>
<script>
      function abrirNuevoTab(url) {
        // Abrir nuevo tab
        var win = window.open(url, '_blank');
        // Cambiar el foco al nuevo tab (punto opcional)
        win.focus();
      }
      $('#open').click(function(){
        abrirNuevoTab('https://forms.office.com/Pages/ResponsePage.aspx?id=53YPJQVh40KC0L58RgrqWRTOjlmffnVHjeQN4hD3CJBUQUtTWTVYTTlaSFNMUlNVN0ZWVTc5Rk1XVi4u')
      })
    </script>
@endsection