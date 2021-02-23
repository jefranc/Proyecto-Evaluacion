<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Pregunta;

class Preguntas_CoeController extends Controller
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

        $preguntas_tics = Pregunta::where([['tipo', 'coevaluacion'], ['categoria_id', '1']])->get();
        $preguntas_peda = Pregunta::where([['tipo', 'coevaluacion'], ['categoria_id', '2']])->get();
        $preguntas_dida = Pregunta::where([['tipo', 'coevaluacion'], ['categoria_id', '3']])->get();
        return view('inserts/preguntas_auto',  compact(
            'name',
            'cedula',
            'email',
            'fechaActual',
            'imagen',
            'preguntas_tics',
            'preguntas_peda',
            'preguntas_dida'
        ));
    }
}
