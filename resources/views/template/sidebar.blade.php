<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu bg-primary">
    <div class="menu_section bg-info">
        </br>
        <h3>General</h3>
        <ul class="nav side-menu">
            @can('evaluar')
            <li><a> Evaluaciones <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('autoevaluacion.index')}}">Autoevaluacion</a></li>
                </ul>
            </li>
            @endcan
            @can('coevaluar')
            <li><a href="{{route('coevaluacion_lista.index')}}"> Co-Evaluación-Lista de Docentes</a></li>
            @endcan
            @can('resultados')
            <li><a> Resultados <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    @can('misresultados')
                    <li><a href="{{ route('resultados.index') }}"> Mis Resultados</a></li>
                    @endcan
                    @can('todosresultados')
                    <li><a href="{{ route('resultados_todos.index') }}"> Resultados de los Docentes</a></li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('ver_docentes')
            <li><a href="{{route('docentes')}}"> Editar Información de los Usuarios</a></li>
            @endcan
            @can('dar_permisos')
            <li><a href="{{ route('docentes') }}"> Editar Información de los Usuarios</a></li>
            @endcan

            @can('areas')
            <li><a href="{{route('asignacion_coevaluador.index')}}"> Lista de Docentes Coevaluadores</a></li>
            @endcan
            @can('areas')
            <li><a> Manejo de Información <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('ciclos.index')}}"> Ciclos</a></li>
                    <li><a href="{{route('area.index')}}"> Areas de Conocimientos</a></li>
                    <li><a href="{{route('materias.index')}}"> Materias</a></li>
                    @can('dar_permisos')
                    <li><a href="{{route('mantenimiento.index')}}"> Mantenimiento</a></li>
                    @endcan
                    <li><a> Información Adicional <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('criterios')}}"> Criterios de Evaluación</a></li>
                            <li><a href="{{ route('preguntas_auto') }}"> Preguntas de Autoevaluación</a></li>
                            <li><a href="{{route('preguntas_coe')}}"> Preguntas de Coevaluación</a></li>
                        </ul>
                    </li>
                </ul>
                @endcan
            <li><a href="{{route('recomendaciones')}}"> Cursos Disponibles </a></li>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->