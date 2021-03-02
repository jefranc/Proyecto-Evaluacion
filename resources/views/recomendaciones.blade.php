@extends('base')

@section('title', 'Recomendaciones')

@section('content')
<div class="page-title">
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h1>Te recomendamos estos cursos!!!</h1>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table" style="width:20%">
                    <h3>Cursos Disponibles</h3>
                    @foreach($cursos as $curso)
                    <p class="fa fa-book" aria-hidden="true"> {{ $curso->curso }}</p></br>
                    @endforeach
                </div>
                <div class="table" style="width:20%">
                    @if(($total_auto != null) || ($total_coe != null))
                    @if(($resultado_auto_tic < 76 ) || ($resultado_auto_peda < 76 ) || ($resultado_auto_dida < 76 ) || ($resultado_coe_tic < 76 ) || ($resultado_coe_peda < 76 ) || ($resultado_coe_dida < 76 )) 
                    <h3>Cursos Requeridos</h3>
                        @if(($resultado_auto_tic < 76 ) || ($resultado_coe_tic < 76 )) 
                            @foreach($cursos as $curso)
                                @if($curso->criterio == 'Tics')
                                    <p class="fa fa-plus-square-o" aria-hidden="true"> {{ $curso->curso }}</p></br>
                                @endif
                            @endforeach
                        @endif
                        @if(($resultado_auto_peda < 76 ) || ($resultado_coe_peda < 76 )) 
                            @foreach($cursos as $curso)
                                @if($curso->criterio == 'Pedagogía')
                                    <p class="fa fa-plus-square-o" aria-hidden="true"> {{ $curso->curso }}</p></br>
                                @endif
                            @endforeach
                        @endif
                        @if(($resultado_auto_dida < 76 ) || ($resultado_coe_dida < 76 )) 
                            @foreach($cursos as $curso)
                                @if($curso->criterio == 'Didáctica')
                                    <p class="fa fa-plus-square-o" aria-hidden="true"> {{ $curso->curso }}</p></br> 
                                @endif
                            @endforeach
                        @endif

                        @endif 
                        @endif 
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