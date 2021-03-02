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
                <div class="row">
                    <?php
                    $array_id = array();
                    $cont = 0;
                    ?>
                    <div class="table" style="width:100%">
                        @if(($total_auto != null) || ($total_coe != null))
                        @if(($resultado_auto_tic < 76 ) || ($resultado_auto_peda < 76 ) || ($resultado_auto_dida < 76 ) || ($resultado_coe_tic < 76 ) || ($resultado_coe_peda < 76 ) || ($resultado_coe_dida < 76 )) <h3>Cursos Requeridos</h3>
                            @foreach($cursos as $curso)
                            @if(($resultado_auto_tic < 76 ) || ($resultado_coe_tic < 76 )) @if($curso->criterio == 'Tics')
                                <div class="col-md-55">
                                    <div class="thumbnail">
                                        <div class="image view view-first">
                                            <img style="width: 100%; display: block;" src={{ URL::asset($didactica) }} alt="image" />
                                            <div class="mask">
                                                <p>{{ $curso->criterio }}</p>
                                                <div class="tools tools-bottom">
                                                    <a href="#"><i class="fa fa-link"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="caption">
                                            <center>
                                                <p>{{ $curso->curso }}</p>
                                                
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endif
                                @if(($resultado_auto_peda < 76 ) || ($resultado_coe_peda < 76 )) @if($curso->criterio == 'Pedagogía')
                                    <div class="col-md-55">
                                        <div class="thumbnail">
                                            <div class="image view view-first">
                                                <img style="width: 100%; display: block;" src={{ URL::asset($didactica) }} alt="image" />
                                                <div class="mask">
                                                    <p>{{ $curso->criterio }}</p>
                                                    <div class="tools tools-bottom">
                                                        <a href="#"><i class="fa fa-link"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="caption">
                                                <center>
                                                    <p>{{ $curso->curso }}</p>
                                                    
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                    @if(($resultado_auto_dida < 76 ) || ($resultado_coe_dida < 76 )) @if($curso->criterio == 'Didáctica')
                                        <div class="col-md-55">
                                            <div class="thumbnail">
                                                <div class="image view view-first">
                                                    <img style="width: 100%; display: block;" src={{ URL::asset($didactica) }} alt="image" />
                                                    <div class="mask">
                                                        <p>{{ $curso->criterio }}</p>
                                                        <div class="tools tools-bottom">
                                                            <a href="#"><i class="fa fa-link"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="caption">
                                                    <center>
                                                        <p>{{ $curso->curso }}</p>
                                                        
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endif
                                        @endforeach
                                        @endif
                                        @endif
                    </div>

                </div>
                <div class="table" style="width:20%">
                    <h3>Cursos Opcionales</h3>
                    @foreach($cursos as $curso)
                    @foreach($array_id as $array_i)
                    {{$array_i}}
                    @if($array_i =! $curso)
                    <p class="fa fa-book" aria-hidden="true"> {{ $curso->curso }}</p></br>
                    @break
                    @endif
                    @endforeach
                    @endforeach
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