<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pregunta;

class CriteriosController extends Controller
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
        $imagen = auth()->user()->imagen;
        

        $criterios = \DB::select('select * from categorias');
        return view('inserts/criterios',  compact(
            'name',
            'cedula',
            'email',
            'imagen',
            'criterios'
        ));
    }
}
