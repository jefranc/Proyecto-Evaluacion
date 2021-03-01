<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ciclo;
use App\Respuesta;
use App\Categoria;
use App\materia_user;

class RecomendacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $name = auth()->user()->name;
        $cedula = auth()->user()->cedula;
        $email = auth()->user()->email;
        $fechaActual = date('d/m/Y');
        $imagen = auth()->user()->imagen;
        $tics = 'Imagenes\TICS.png';
        $peda = 'Imagenes\PEDAGOGIA.png';
        $dida = 'Imagenes\DIDACTICA.png';

        return view('recomendaciones',  compact(
            'name',
            'cedula',
            'email',
            'fechaActual',
            'imagen',
            'tics',
            'peda',
            'dida'
        ));
    }
}
