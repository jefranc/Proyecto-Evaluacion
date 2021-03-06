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
                <center><h1>Cursos de capacitación para docentes</h1>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <?php
                    $array_id = array();
                    $array_id2 = array();
                    $cont = 0;
                    $comp = '0';
                    ?>
                    <div class="table" style="width:100%">
                        @if(($total_auto != null) || ($total_coe != null))
                        @if(($resultado_auto_tic < 76 ) || ($resultado_auto_peda < 76 ) || ($resultado_auto_dida < 76 ) || ($resultado_coe_tic < 76 ) || ($resultado_coe_peda < 76 ) || ($resultado_coe_dida < 76 )) <h3>Cursos Requeridos</h3>
                            @foreach($cursos as $curso)
                            @if(($resultado_auto_tic < 76 ) || ($resultado_coe_tic < 76 )) @if($curso->criterio == 'Tics')
                                <div class="col-md-55">
                                    <div class="thumbnail">
                                        <div class="image view view-first">
                                            <img style="width: 100%; display: block;" src={{ URL::asset($curso->imagen) }} alt="image" />
                                            <div class="mask">
                                                <p>{{ $curso->criterio }}</p>
                                                <div class="tools tools-bottom">
                                                    <a href="#"><i class="fa fa-link"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="caption">
                                            <center>
                                                <p>{{ $curso->curso }} </p>
                                                <?php
                                                $comp = 1;
                                                ?>
                                        </div>
                                    </div>
                                </div>

                                @endif
                                @endif
                                @if(($resultado_auto_peda < 76 ) || ($resultado_coe_peda < 76 )) @if($curso->criterio == 'Pedagogía')
                                    <div class="col-md-55">
                                        <div class="thumbnail">
                                            <div class="image view view-first">
                                                <img style="width: 100%; display: block;" src={{ URL::asset($curso->imagen) }} alt="image" />
                                                <div class="mask">
                                                    <p>{{ $curso->criterio }}</p>
                                                    <div class="tools tools-bottom">
                                                        <a href="#"><i class="fa fa-link"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="caption">
                                                <center>
                                                    <p>{{ $curso->curso }} </p>
                                                    <?php
                                                    $comp = 1;
                                                    ?>
                                            </div>
                                        </div>
                                    </div>

                                    @endif
                                    @endif
                                    @if(($resultado_auto_dida < 76 ) || ($resultado_coe_dida < 76 )) @if($curso->criterio == 'Didáctica')
                                        <div class="col-md-55">
                                            <div class="thumbnail">
                                                <div class="image view view-first">
                                                    <img style="width: 100%; display: block;" src={{ URL::asset($curso->imagen) }} alt="image" />
                                                    <div class="mask">
                                                        <p>{{ $curso->criterio }}</p>
                                                        <div class="tools tools-bottom">
                                                            <a href="#"><i class="fa fa-link"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="caption">
                                                    <center>
                                                        <p>{{ $curso->curso }} </p>
                                                        <?php
                                                        $comp = 1;
                                                        ?>
                                                </div>
                                            </div>
                                        </div>

                                        @endif
                                        @endif
                                        @if($comp == 0)
                                        <?php
                                        $array_id[$cont] = $curso->curso;
                                        $array_id2[$cont] = $curso->criterio;
                                        $cont = $cont + 1;
                                        $comp = '0';
                                        ?>
                                        @else
                                        <?php
                                        $comp = '0';
                                        ?>
                                        @endif
                                        @endforeach
                                        @endif
                                        </br>
                                        <div class="x_content" style="width:100%">
                                            <h3>Cursos Opcionales</h3>
                                            @foreach($array_id as $array_i) <div class="col-md-55">
                                                <div class="thumbnail">
                                                    <div class="image view view-first">
                                                        @foreach($cursos as $curso)
                                                        @if($array_i == $curso->curso)
                                                        <img style="width: 100%; display: block;" src={{ URL::asset($curso->imagen) }} alt="image" />
                                                        @endif
                                                        @endforeach
                                                        <div class="mask">
                                                            <p></p>
                                                            <div class="tools tools-bottom">
                                                                <a href="#"><i class="fa fa-link"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="caption">
                                                        <center>
                                                            <p>{{ $array_i }} </p>
                                                    </div>
                                                </div>
                                            </div>

                                            @endforeach
                                        </div>
                                        @else
                                        <div class="x_content" style="width:100%">
                                            <h3>Cursos Opcionales</h3>
                                            @foreach($cursos as $curso) <div class="col-md-55">
                                                <div class="thumbnail">
                                                    <div class="image view view-first">
                                                        <img style="width: 100%; display: block;" src={{ URL::asset($curso->imagen) }} alt="image" />
                                                        <div class="mask">
                                                            <p></p>
                                                            <div class="tools tools-bottom">
                                                                <a href="#"><i class="fa fa-link"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="caption">
                                                        <center>
                                                            <p>{{ $curso->curso }} </p>
                                                    </div>
                                                </div>
                                            </div>

                                            @endforeach
                                        </div>
                                        @endif
                    </div>
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