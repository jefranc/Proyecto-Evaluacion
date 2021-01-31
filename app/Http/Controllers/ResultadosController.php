<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ciclo;
use App\Respuesta;
use App\Categoria;

class ResultadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;
        $name = auth()->user()->name;
        $cedula = auth()->user()->cedula;
        $email = auth()->user()->email;
        $imagen = auth()->user()->imagen;
        $ciclo = Ciclo::all();
        $ci = 0;

        return view('resultados',  compact('id', 'name', 'cedula', 'email', 'imagen', 'ciclo', 'ci'));
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
    public function show($ciclos)
    {
        $id = auth()->user()->id;
        $name = auth()->user()->name;
        $cedula = auth()->user()->cedula;
        $email = auth()->user()->email;
        $imagen = auth()->user()->imagen;
        $ciclo = Ciclo::all();
        $ci = 1;
        $array = array();
        $res = \DB::table('respuestas')->where('user_id', $cedula)->where('ciclo', $ciclos)->get();
        $tic = \DB::table('respuestas')->where('user_id', $cedula)->where('ciclo', $ciclos)->where('categoria', 1)->get();
        $peda = \DB::table('respuestas')->where('user_id', $cedula)->where('ciclo', $ciclos)->where('categoria', 2)->get();
        $dida = \DB::table('respuestas')->where('user_id', $cedula)->where('ciclo', $ciclos)->where('categoria', 3)->get();


        return view('resultados',  compact('id', 'name', 'cedula', 'email', 'imagen', 'ciclo', 'ci', 'res', 'tic', 'peda', 'dida'));
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
    public function update(Request $request, $id)
    {
        //
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
