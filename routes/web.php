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
        Route::get('/evaluacion2','Evaluacion2Controller@index')->name('evaluacion2');         
        Route::resource('editar_perfil', 'Editar_PerfilController');
        Route::resource('autoevaluacion', 'AutoevaluacionController');
    });
    Route::group(['middleware' => ['permission:coevaluar']], function () {
        Route::get('/coevaluacion_lista','Coevaluacion_ListaController@index')->name('coevaluacion_lista');
    });
    Route::group(['middleware' => ['permission:ver_docentes|dar_permisos']], function () {
        Route::get('/docentes','DocentesController@index')->name('docentes');
    });
    Route::group(['middleware' => ['permission:dar_permisos']], function () {
        Route::resource('permisos', 'PermisosController');
    });
    
});