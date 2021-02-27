<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ciclo;
use App\area_conocimiento;
use App\materia;
use App\comprobacione_auto;
use App\comprobacione;

class MantenimientoController extends Controller
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
        $ciclos = Ciclo::all();
        $ciclo_actual = Ciclo::where('ciclo_actual', '2')->first();
        if ($ciclo_actual == null) {
            $ciclo_actual = ' ';
        } else {
            $ciclo_actual = $ciclo_actual->ciclo;
        }
        $areas = area_conocimiento::all();
        $materias = materia::all();
        return view('inserts/mantenimiento',  compact(
            'name',
            'cedula',
            'email',
            'imagen',
            'areas',
            'materias',
            'ciclo_actual',
            'ciclos'
        ));
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
        //limpiar tablas temporales
        if ($tipo == 'limpiar_base') {
            $users = User::all();
            foreach ($users as $user) {
                $user->evaluador1 = null;
                $user->evaluador2 = null;
                $user->evaluador3 = null;
                $user->evaluador4 = null;
                $user->evaluador5 = null;
                $user->auto = '0';
                $user->save();
            }


            $compro = comprobacione::all();
            foreach ($compro as $compr) {
                $compr->delete();
            }
        }
        return redirect()->route('mantenimiento.index');
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
