<?php

namespace App\Http\Controllers;

use App\User;
use App\Pregunta;
use App\Respuesta;
use App\Ciclo;
use App\materia_user;
use App\materia;
use Illuminate\Http\Request;
use App\Comprobacione;

class Coevaluacion_ListaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $id = auth()->user()->id;
        $name = auth()->user()->name;
        $cedula = auth()->user()->cedula;
        $email = auth()->user()->email;
        $fechaActual = date('d/m/Y');
        $imagen = auth()->user()->imagen;

        $comprobacion = Comprobacione::all();
        
        $preguntas = Pregunta::where('tipo', 'coevaluacion')->get();
        $ciclo = Ciclo::where('ciclo_actual', '2')->get();
        $cont = Ciclo::where('ciclo_actual', '2')->count();
        if ($cont == 0) {
            $ciclo = null;
        }
        $ci = 0;
        $materias = materia::all();
        $materias_user = materia_user::all();

        return view('coevaluacion_lista',  compact(
            'id',
            'name',
            'cedula',
            'email',
            'fechaActual',
            'imagen',
            'preguntas',
            'ciclo',
            'ci',
            'materias',
            'materias_user',
            'comprobacion'
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
    public function show()
    {
        $id = auth()->user()->id;
        $name = auth()->user()->name;
        $cedula = auth()->user()->cedula;
        $email = auth()->user()->email;
        $fechaActual = date('d/m/Y');
        $imagen = auth()->user()->imagen;
        $docentes = User::where('evaluador1', $cedula)->orWhere('evaluador2', $cedula)
        ->orWhere('evaluador3', $cedula)->orWhere('evaluador4', $cedula)->orWhere('evaluador4', $cedula)
        ->orWhere('evaluador5', $cedula)->get();
        $comprobacion = \DB::select('select * from comprobaciones');

 

        $preguntas = Pregunta::where('tipo', 'coevaluacion')->get();
        $ciclo = Ciclo::where('ciclo_actual', '2')->get();
        $ci = 2;
        $materias = materia::all();
        $materias_user = materia_user::all();

        return view('coevaluacion_lista',  compact(
            'id',
            'name',
            'cedula',
            'email',
            'fechaActual',
            'docentes',
            'imagen',
            'preguntas',
            'ciclo',
            'ci',
            'materias',
            'materias_user',
            'comprobacion'
        ));

       return $docentes;
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
    public function update(Request $request, $cedula)
    {

        $ced = $request->cedula;
        $user = User::where('cedula', '=', $ced)->first();
        $ciclo = Ciclo::where('ciclo_actual', '2')->first();
        $preguntas = \DB::table('preguntas')->where('tipo', '=', 'coevaluacion')->get();
        $vare = 0;
        foreach ($preguntas as $preguntas) {
            $respuesta = new Respuesta;
            $vare = $preguntas->id;
            $respuesta->resultado = $request->$vare;
            $respuesta->user_id = $request->cedula;
            $respuesta->pregunta_id = $vare;
            $respuesta->ciclo = $ciclo->ciclo;
            $respuesta->categoria = $preguntas->categoria_id;
            $respuesta->tipo = $preguntas->tipo;
            $respuesta->save();
        }
        $user->status = '1';
        $user->save();
        return redirect()->route('coevaluacion_lista.show', $user->id);
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
