<?php

use Illuminate\Support\Facades\Route;
use App\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

//Route::get('evaluacion1','TemplateController@index');

//Route::get('principal', 'TemplateController@principal')->name('principal');

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::group(['middleware' => ['permission:coevaluar|ver_docentes|dar_permisos|evaluar']], function () {
        Route::get('/index', 'TemplateController@index')->name('index');
        Route::get('/recomendaciones','RecomendacionesController@index')->name('recomendaciones');      
        Route::resource('editar_perfil', 'Editar_PerfilController');
        Route::resource('autoevaluacion', 'AutoevaluacionController');
        Route::resource('resultados', 'ResultadosController');
    });
    Route::group(['middleware' => ['permission:coevaluar']], function () {
        Route::resource('coevaluacion_lista', 'Coevaluacion_ListaController');
        Route::resource('coevaluacion', 'CoevaluacionController');

    });
    Route::group(['middleware' => ['permission:ver_docentes|dar_permisos']], function () {
        Route::get('/docentes','DocentesController@index')->name('docentes');
        Route::get('/preguntas_auto','Preguntas_AutoController@index')->name('preguntas_auto');
        Route::get('/preguntas_coe','Preguntas_CoeController@index')->name('preguntas_coe');
        Route::get('/criterios','CriteriosController@index')->name('criterios');
        Route::resource('editar_usuario', 'Editar_UsuarioController');  
        Route::resource('resultados_todos', 'Resultados_TodosController');  
        Route::resource('resultado_docente', 'Resultado_DocenteController'); 
        Route::resource('asignacion_coevaluador', 'Asignacion_CoevaluadorController');  
        Route::resource('materias', 'MateriasController');  
        Route::resource('lista_mis_docentes', 'Lista_Mis_DocentesController');
        Route::resource('ciclos', 'CiclosController');   
        Route::resource('area', 'AreaController');  
    });
    Route::group(['middleware' => ['permission:dar_permisos']], function () {
        Route::resource('mantenimiento', 'MantenimientoController');  
  
    });
    
});