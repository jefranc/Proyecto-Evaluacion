<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ciclo;
use App\comprobacione;

class Lista_Mis_DocentesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $name = auth()->user()->name;
        $apellido = auth()->user()->apellido;
        $cedula = $request->cedula;
        $email = auth()->user()->email;
        $imagen = auth()->user()->imagen;

        $user_coe = User::where('cedula', $cedula)->first();

        $docentes = \DB::select('select * from users ORDER BY apellido');
        return view('inserts/lista_mis_docentes',  compact(
            'name',
            'apellido',
            'cedula',
            'email',
            'imagen',
            'docentes',
            'user_coe'
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
    public function show($cedula)
    {
        $name = auth()->user()->name;
        $apellido = auth()->user()->apellido;
        $email = auth()->user()->email;
        $imagen = auth()->user()->imagen;

        $user_coe = User::where('cedula', $cedula)->first();

        $docentes = \DB::select('select * from users ORDER BY apellido');
        return view('inserts/lista_mis_docentes',  compact(
            'name',
            'apellido',
            'cedula',
            'email',
            'imagen',
            'docentes',
            'user_coe'
        ));
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
        if ($tipo == 'eliminar_docente') {
            $ced_coe = $request->cedula;
            $evaluador1 = User::where('cedula', $request->cedula2)->first();

            if ($evaluador1->evaluador1 == $ced_coe) {
                $evaluador1->evaluador1 = null;

                comprobacione::where([['ci_coevaluador_id', $ced_coe], ['evaluado', $evaluador1->cedula]])->delete();
            } elseif ($evaluador1->evaluador2 == $ced_coe) {
                $evaluador1->evaluador2 = null;
                comprobacione::where([['ci_coevaluador_id', $ced_coe], ['evaluado', $evaluador1->cedula]])->delete();
            } elseif ($evaluador1->evaluador3 == $ced_coe) {
                $evaluador1->evaluador3 = null;
                comprobacione::where([['ci_coevaluador_id', $ced_coe], ['evaluado', $evaluador1->cedula]])->delete();
            } elseif ($evaluador1->evaluador4 == $ced_coe) {
                $evaluador1->evaluador4 = null;
                comprobacione::where([['ci_coevaluador_id', $ced_coe], ['evaluado', $evaluador1->cedula]])->delete();
            } elseif ($evaluador1->evaluador5 == $ced_coe) {
                $evaluador1->evaluador5 = null;
                comprobacione::where([['ci_coevaluador_id', $ced_coe], ['evaluado', $evaluador1->cedula]])->delete();
            }
            $evaluador1->save();
        }

        if ($tipo == 'añadir_docente') {
            $ced_coe = $request->cedula;
            //se busca un lugar para almacenar la cedula del coevaluador
            foreach ($request->cedulass as $request->cedulas) {
                $evaluador1 = User::where('cedula', $request->cedulas)->first();

                if ($evaluador1->evaluador1 == null) {
                    $evaluador1->evaluador1 = $ced_coe;

                    $comprobar = new Comprobacione;
                    $comprobar->ci_coevaluador_id = $ced_coe;
                    $comprobar->evaluado = $evaluador1->cedula;
                    $comprobar->estado = '0';
                    $comprobar->save();
                } elseif ($evaluador1->evaluador2 == null) {
                    $evaluador1->evaluador2 = $ced_coe;

                    $comprobar = new Comprobacione;
                    $comprobar->ci_coevaluador_id = $ced_coe;
                    $comprobar->evaluado = $evaluador1->cedula;
                    $comprobar->estado = '0';
                    $comprobar->save();
                } elseif ($evaluador1->evaluador3 == null) {
                    $evaluador1->evaluador3 = $ced_coe;

                    $comprobar = new Comprobacione;
                    $comprobar->ci_coevaluador_id = $ced_coe;
                    $comprobar->evaluado = $evaluador1->cedula;
                    $comprobar->estado = '0';
                    $comprobar->save();
                } elseif ($evaluador1->evaluador4 == null) {
                    $evaluador1->evaluador4 = $ced_coe;

                    $comprobar = new Comprobacione;
                    $comprobar->ci_coevaluador_id = $ced_coe;
                    $comprobar->evaluado = $evaluador1->cedula;
                    $comprobar->estado = '0';
                    $comprobar->save();
                } elseif ($evaluador1->evaluador5 == null) {
                    $evaluador1->evaluador5 = $ced_coe;

                    $comprobar = new Comprobacione;
                    $comprobar->ci_coevaluador_id = $ced_coe;
                    $comprobar->evaluado = $evaluador1->cedula;
                    $comprobar->estado = '0';
                    $comprobar->save();
                }
                $evaluador1->save();
            }
        }

        return redirect()->route('lista_mis_docentes.show', $ced_coe);
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
