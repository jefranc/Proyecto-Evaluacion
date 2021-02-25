@extends('base')

@section('title', 'Editar Perfil')

@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Perfil Docente</h3>
        </div>
    </div>
    <div class="clearfix">
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Información del Docente</h2>
                    @can('dar_permisos')
                    <div class="pull-right">
                        <button class="btn-outline-danger" data-toggle="modal" data-target="#modaleliminar">Eliminar Usuario</button>
                    </div>
                    @endcan
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix">
                    </div>
                </div>
                <div class="x_content">
                    <div class="col-md-9 col-sm-9 ">
                        <div class="profile_title">
                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="autoevaluacion" class="nav nav-tabs bar_tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#informacion_perfil" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Información de Perfil</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#area_conocimiento" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Area de Conocimiento</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#materias" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Materias</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#permisos" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="false">Roles</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane active " id="informacion_perfil" aria-labelledby="home-tab">
                                        <div class="x_content">
                                            <div class="profile_img">
                                                <div id="crop-avatar">
                                                    <img class="img-responsive avatar-view" src={{ URL::asset($usuario1->imagen) }} alt="Avatar" title="Change the avatar">
                                                </div>
                                            </div>
                                            <h3>{{ $usuario1->name }} {{ $usuario1->apellido }}</h3>
                                            <ul class="list-unstyled user_data">
                                                <li><i class="fa fa-id-card-o"></i> {{ $usuario1->cedula }}
                                                </li>
                                                <li><i class="fa fa-envelope"></i> {{ $usuario1->email }}
                                                </li>
                                                @if($roles_admin == 'Administrador')
                                                <li><i class="fa fa-font-awesome"></i> {{ $roles_admin }}
                                                </li>
                                                @endif
                                                @if($roles_di == 'Director')
                                                <li><i class="fa fa-font-awesome"></i> {{ $roles_di }}
                                                </li>
                                                @endif
                                                @if($roles_co == 'CoEvaluador')
                                                <li><i class="fa fa-font-awesome"></i> {{ $roles_co }}
                                                </li>
                                                @endif
                                                @if($roles_do == 'Docente')
                                                <li><i class="fa fa-font-awesome"></i> {{ $roles_do }}
                                                </li>
                                                @endif
                                            </ul>
                                            @can('dar_permisos')
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                                Editar Información de Perfil
                                            </button>
                                            @endcan
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="area_conocimiento" aria-labelledby="profile-tab">
                                        <div class="pull-left">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="bg-info">
                                                        <th scope="col">#</th>
                                                        <th scope="col">Areas del conocimiento a cargo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $num = 1;
                                                    ?>
                                                    @foreach($user_areas as $user_area)
                                                    <tr>
                                                        <th scope="row">{{ $num }}</th>
                                                        <td>{{ $user_area->area }}</td>
                                                    </tr>
                                                    <?php
                                                    $num = $num + 1;
                                                    ?>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php
                                        $tipo2 = 'area';
                                        ?>
                                        <form method="POST" action="{{ route('editar_usuario.update', $tipo2) }}">
                                            @csrf
                                            @method('put')
                                            <div class="x_content">
                                                <div class="">
                                                    <input type="hidden" name="cedula" id="cedula" value="{{ $usuario1->cedula }}" />
                                                    <button type="submit" class="btn btn-primary" style="float: right">Guardar</button>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" style="width:50%" id="search2" placeholder="Buscar Area...">
                                                    </div>
                                                    <table class="table table-bordered pull-right" id="mytable2">
                                                        <thead>
                                                            <tr class="bg-info">
                                                                <th colspan="6">Areas Disponibles</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $ar = array();
                                                            $con = 0;
                                                            ?>
                                                            @foreach($areas as $area)
                                                            @if($areacount >=1 )
                                                            <tr>
                                                                @foreach($areas_user as $areas_use)
                                                                @if($area->id == $areas_use->area_conocimiento_id )
                                                                <td><input type="checkbox" name="areas[]" class="flat" value="{{ $area->area}}" checked> {{ $area->area }}</td>
                                                                <?php
                                                                $ar[$con] = $area->area;
                                                                $con = $con + 1;
                                                                $co = 0;
                                                                ?>
                                                                @break
                                                                @endif
                                                                @endforeach
                                                                @if($area->id != $areas_use->area_conocimiento_id )
                                                                <td><input type="checkbox" name="areas[]" class="flat" value="{{ $area->area }}"> {{ $area->area }}</td>
                                                                @endif
                                                                @else
                                                                <td><input type="checkbox" name="areas[]" class="flat" value="{{ $area->area }}"> {{ $area->area }}</td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="materias" aria-labelledby="profile-tab">
                                        <div class="pull-left">
                                            <table class="table table-bordered pull-right">
                                                <thead>
                                                    <tr class="bg-info">
                                                        <th scope="col">#</th>
                                                        <th scope="col">Materias que imparte el docente</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $num = 1;
                                                    ?>
                                                    @foreach($mate_user as $mate_use)
                                                    <tr>
                                                        <th scope="row">{{ $num }}</th>
                                                        <td>{{ $mate_use->materia }}</td>
                                                    </tr>
                                                    <?php
                                                    $num = $num + 1;
                                                    ?>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php
                                        $tipo3 = 'materia';
                                        ?>
                                        <form method="POST" action="{{ route('editar_usuario.update', $tipo3) }}">
                                            @csrf
                                            @method('put')
                                            <div class="x_content">
                                                <div class="">
                                                    <input type="hidden" name="cedula" id="cedula" value="{{ $usuario1->cedula }}" />
                                                    <button type="submit" class="btn btn-primary" style="float: right">Guardar</button>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" style="width:50%" id="search" placeholder="Buscar Materia...">
                                                    </div>
                                                    <table class="table table-bordered pull-right" id="mytable">
                                                        <thead>
                                                            <tr class="bg-info">
                                                                <th colspan="6">Materias Disponibles</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($materias as $materia)
                                                            @foreach($ar as $a)
                                                            @if($materia->area == $a)
                                                            @if($matecount >=1 )
                                                            <tr>
                                                                @foreach($mate as $mat)
                                                                @if($materia->id == $mat->materias_id )
                                                                <td><input type="checkbox" name="materia[]" class="flat" value="{{ $materia->materia }}" checked> {{ $materia->materia }}</td>
                                                                @break
                                                                @endif
                                                                @endforeach
                                                                @if($materia->id != $mat->materias_id )
                                                                <td><input type="checkbox" name="materia[]" class="flat" value="{{ $materia->materia }}"> {{ $materia->materia }}</td>
                                                                @endif
                                                                @else
                                                                <td><input type="checkbox" name="materia[]" class="flat" value="{{ $materia->materia }}"> {{ $materia->materia }}</td>
                                                            </tr>
                                                            @endif
                                                            @endif
                                                            @endforeach
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="permisos" aria-labelledby="profile-tab">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2>Lista de Roles </h2>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">
                                                <div class="">
                                                    <?php
                                                    $tipo4 = 'permisos';
                                                    ?>
                                                    <form method="POST" action="{{ route('editar_usuario.update', $tipo4) }}">
                                                        @csrf
                                                        @method('put')
                                                        <ul class="to_do">
                                                            <li>
                                                                <p>@if($roles_di == 'Director')
                                                                    <input id="rol" type="checkbox" name="rol_director" class="flat" value="Director" checked> Director
                                                                    @else
                                                                    <input id="rol" type="checkbox" name="rol_director" class="flat" value="Director"> Director
                                                                    @endif
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>@if($roles_co == 'CoEvaluador')
                                                                    <input id="rol" type="checkbox" name="rol_coevaluador" class="flat" value="CoEvaluador" checked> CoEvaluador
                                                                    @else
                                                                    <input id="rol" type="checkbox" name="rol_coevaluador" class="flat" value="CoEvaluador"> CoEvaluador
                                                                    @endif
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <p>@if($roles_do == 'Docente')
                                                                    <input id="rol" type="checkbox" name="rol_docente" class="flat" value="Docente" checked> Docente
                                                                    @else
                                                                    <input id="rol" type="checkbox" name="rol_docente" class="flat" value="Docente"> Docente
                                                                    @endif
                                                                </p>
                                                            </li>
                                                        </ul>
                                                        <input type="hidden" name="cedula" id="cedulas" value="{{ $usuario1->cedula }}" />
                                                        <button type="submit" class="btn btn-primary" style="float: right">Guardar Cambios</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Button trigger modal -->

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Editar Perfil</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <!-- Inicio del Contenido-->
                                        <div class="modal-body">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <br />
                                                    <?php
                                                    $tipo = 'informacion';
                                                    ?>
                                                    <form action="{{ route('editar_usuario.update', $tipo) }}" class="form-label-left input_mask" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                            <h2>Nombre</h2>
                                                            <input type="text" class="form-control" name="name" value="{{ $usuario1->name }}">
                                                            @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                            <h2>Apellido</h2>
                                                            <input type="text" class="form-control" name="apellido" value="{{ $usuario1->apellido }}">
                                                            @error('apellido')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                            <h2>Email</h2>
                                                            <input type="email" class="form-control" name="email" value="{{ $usuario1->email }}">
                                                            @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                            <h2>Cedula</h2>
                                                            <input type="cedula" class="form-control" name="cedula" value="{{ $usuario1->cedula }}">
                                                            @error('cedula')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                            <h2>Contraseña</h2>
                                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Escriba su Contraseña Aqui">
                                                            @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                            </br>
                                                            </br>
                                                            </br>
                                                            </br>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary" style="float: right">Guardar</button>
                                                        <button type="button" class="btn btn-secondary" style="float: right" data-dismiss="modal">Cerrar</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Eliminar -->
<div class="modal fade" id="modaleliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">¿Seguro que desea eliminar este usuario?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <?php
                $tipo = 'eliminar';
                ?>
                <form action="{{ route('editar_usuario.update',$tipo) }}" method="POST">
                    @csrf
                    @method('put')
                    <input type="hidden" name="cedula" id="elicedula" value="{{ $usuario1->cedula }}" />
                    <button class="btn btn-primary">Si, eliminar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
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
        $("#search2").keyup(function() {
            _this = this;
            // Show only matching TR, hide rest of them
            $.each($("#mytable2 tbody tr"), function() {
                if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();
            });
        });
    });
</script>
@endsection