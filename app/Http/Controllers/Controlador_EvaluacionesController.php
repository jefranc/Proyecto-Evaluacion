<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ciclo;
use App\comprobacione;

class Controlador_EvaluacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = auth()->user()->name;
        $cedula = auth()->user()->cedula;
        $email = auth()->user()->email;
        $fechaActual = date('d/m/Y');
        $imagen = auth()->user()->imagen;
        $tipo = 'todos';

        $docentes = \DB::select('select * from users ORDER BY apellido');
        $ciclo = Ciclo::all();
        return view('controlador_evaluaciones',  compact('name', 'cedula', 'email', 'fechaActual', 'imagen', 'docentes', 'ciclo', 'tipo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tipo)
    {
        if($tipo == 'auto'){
            $name = auth()->user()->name;
            $cedula = auth()->user()->cedula;
            $email = auth()->user()->email;
            $fechaActual = date('d/m/Y');
            $imagen = auth()->user()->imagen;
            $tipo = 'auto';

            $docentes = \DB::select('select * from users ORDER BY apellido');
        return view('controlador_evaluaciones',  compact('name', 'cedula', 'email', 'fechaActual', 'imagen', 'docentes', 'tipo'));
        }

        if($tipo == 'coe'){
            $name = auth()->user()->name;
            $cedula = auth()->user()->cedula;
            $email = auth()->user()->email;
            $fechaActual = date('d/m/Y');
            $imagen = auth()->user()->imagen;
            $tipo = 'coe';
            $compro = \DB::select('select * from comprobaciones');
            $docentes = \DB::select('select * from users ORDER BY apellido');
        return view('controlador_evaluaciones',  compact('name', 'cedula', 'email', 'fechaActual', 'imagen', 'docentes', 'tipo', 'compro'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
