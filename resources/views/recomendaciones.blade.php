@extends('base')

@section('title', 'Recomendaciones')

@section('content')
<div class="page-title">
    <div class="title_left">
        <h3>Te recomendamos estos cursos!!!</h3>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Cursos Disponibles</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <div class="col-md-3 col-sm-6  ">
                    <div class="pricing">
                        <div class="title">
                            <h1>TICS EN LA EDUCACION</h1>
                        </div>
                        <div class="x_content">
                            <div class="">
                                <div class="img">
                                    <img class="img-responsive avatar-view" src={{ URL::asset($tics) }} alt="Avatar" title="Change the avatar">
                                </div>
                            </div>
                            <div class="pricing_footer">
                                <a href="http://lms.intelcomsys.com/courses/course-v1:UniversidaddeGuayaquil+123+2021_T3/about" class="btn btn-success btn-block" role="button" target="_blank">Revisar Curso</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-3 col-sm-6  ">
                    <div class="pricing">
                        <div class="title">
                            <h1>DIDACTICA</h1>
                        </div>
                        <div class="x_content img">
                            <div class="">
                                <div class="img">
                                    <img class="img-responsive avatar-view" src={{ URL::asset($dida) }} alt="Avatar" title="Change the avatar">
                                </div>
                            </div>
                            <div class="pricing_footer">
                                <a href="http://lms.intelcomsys.com/courses/course-v1:UniversidaddeGuayaquil+123+2021_T2/about" class="btn btn-success btn-block" role="button" target="_blank">Revisar Curso</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-3 col-sm-6  ">
                    <div class="pricing">
                        <div class="title">
                            <h1>PEDAGOGIA</h1>
                        </div>
                        <div class="x_content">
                            <div class="">
                                <div class="img">
                                    <img class="img-responsive avatar-view" src={{ URL::asset($peda) }} alt="Avatar" title="Change the avatar">
                                </div>
                            </div>
                            <div class="pricing_footer">
                                <a href="http://lms.intelcomsys.com/courses/course-v1:UniversidaddeGuayaquil+123+2021_T1/about" class="btn btn-success btn-block" role="button" target="_blank">Revisar Curso</a>
                            </div>
                        </div>
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