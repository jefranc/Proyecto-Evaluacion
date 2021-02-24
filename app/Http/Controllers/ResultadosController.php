<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ciclo;
use App\Respuesta;
use App\Categoria;
use App\materia_user;
use App\materia;
use phpDocumentor\Reflection\Types\Null_;
use PDF;


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
        $ciclos = 0;
        $resultado_auto_dida = 0;
        $resultado_auto_peda = 0;
        $resultado_auto_tic = 0;
        $resultado_coe_dida = 0;
        $resultado_coe_peda = 0;
        $resultado_coe_tic = 0;
        $peda = 0;
        $dida = 0;
        $res2 = 0;
        $tic2 = 0;
        $peda2 = 0;
        $dida2 = 0;
        $pedagogico = 0;
        $pregunta_peda = 0;
        $didactica = 0;
        $pregunta_dida = 0;
        $tics = 0;
        $pregunta_tics = 0;
        $pedagogico_coe = 0;
        $pregunta_peda_coe = 0;
        $didactica_coe = 0;
        $pregunta_dida_coe = 0;
        $tics_coe = 0;
        $pregunta_tics_coe = 0;
        $semaforo_verde = 'Imagenes\semaforo_verde.png';
        $semaforo_amarillo = 'Imagenes\semaforo_amarillo.png';
        $semaforo_rojo = 'Imagenes\semaforo_rojo.png';
        $conta_coe = \DB::table('respuestas')->where('user_id', $cedula)->where('ciclo', $ciclos)->where('tipo', '=', 'coevaluacion')->count();
        $conta_auto = \DB::table('respuestas')->where('user_id', $cedula)->where('ciclo', $ciclos)->where('tipo', '=', 'autoevaluacion')->count();
        $materias = materia_user::join("materias", "materias.id", "=", "materia_users.materias_id")->select("materias.materia")
            ->where("materia_users.docente", "=", $cedula)->get();
        $mate = null;
        $total_coe = 0;
        $total_auto = 0;
        $observaciones = \DB::table('respuestas')->select('observaciones')->where('user_id', $cedula)
            ->where('materia', '=', $mate)->where('ciclo', '=', $ciclos)->get();



        return view('resultados',  compact(
            'id',
            'name',
            'cedula',
            'email',
            'imagen',
            'ciclo',
            'ci',
            'peda',
            'dida',
            'res2',
            'tic2',
            'peda2',
            'dida2',
            'resultado_auto_tic',
            'resultado_auto_peda',
            'resultado_auto_dida',
            'resultado_coe_tic',
            'resultado_coe_peda',
            'resultado_coe_dida',
            'pedagogico',
            'pregunta_peda',
            'didactica',
            'pregunta_dida',
            'tics',
            'pregunta_tics',
            'pedagogico_coe',
            'pregunta_peda_coe',
            'didactica_coe',
            'pregunta_dida_coe',
            'tics_coe',
            'pregunta_tics_coe',
            'semaforo_verde',
            'semaforo_amarillo',
            'semaforo_rojo',
            'conta_auto',
            'conta_coe',
            'total_coe',
            'total_auto',
            'materias',
            'mate',
            'observaciones',
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
    public function show(Request $request, $ciclos)
    {


        $id = auth()->user()->id;
        $name = auth()->user()->name;
        $cedula = auth()->user()->cedula;
        $email = auth()->user()->email;
        $imagen = auth()->user()->imagen;
        $ciclo = Ciclo::all();
        $ci = 1;
        $array = array();
        $total_coe = null;
        $total_auto = null;
        $materias = materia_user::join("materias", "materias.id", "=", "materia_users.materias_id")->select("materias.materia")
            ->where("materia_users.docente", "=", $cedula)->get();
        $mate = $request->materia;
        //Obtener Valores Coevaluacion
        $res = \DB::table('respuestas')->where('user_id', $cedula)->where('ciclo', $ciclos)->where('tipo', '=', 'coevaluacion')
            ->where('materia', '=', $mate)->get();
        $conta_coe = \DB::table('respuestas')->where('user_id', $cedula)->where('ciclo', $ciclos)->where('tipo', '=', 'coevaluacion')
            ->where('materia', '=', $mate)->count();
        $tic = \DB::table('respuestas')->select('resultado')->where('user_id', $cedula)->where('ciclo', $ciclos)->where('categoria', 1)
            ->where('tipo', '=', 'coevaluacion')->where('materia', '=', $mate)->get();
        $tic_count_coe = \DB::table('respuestas')->select('resultado')->where('user_id', $cedula)->where('ciclo', $ciclos)
            ->where('categoria', 1)->where('tipo', '=', 'coevaluacion')->where('materia', '=', $mate)->count();
        $peda = \DB::table('respuestas')->select('resultado')->where('user_id', $cedula)->where('ciclo', $ciclos)->where('categoria', 2)
            ->where('tipo', '=', 'coevaluacion')->where('materia', '=', $mate)->get();
        $peda_count_coe = \DB::table('respuestas')->select('resultado')->where('user_id', $cedula)->where('ciclo', $ciclos)
            ->where('categoria', 2)->where('tipo', '=', 'coevaluacion')->where('materia', '=', $mate)->count();
        $dida = \DB::table('respuestas')->select('resultado')->where('user_id', $cedula)->where('ciclo', $ciclos)->where('categoria', 3)
            ->where('tipo', '=', 'coevaluacion')->where('materia', '=', $mate)->get();
        $dida_count_coe = \DB::table('respuestas')->select('resultado')->where('user_id', $cedula)->where('ciclo', $ciclos)
            ->where('categoria', 3)->where('tipo', '=', 'coevaluacion')->where('materia', '=', $mate)->count();
        //Obtener Valores Autoevaluacion
        $res2 = \DB::table('respuestas')->where('user_id', $cedula)->where('ciclo', $ciclos)->where('tipo', '=', 'autoevaluacion')
            ->get();
        $conta_auto = \DB::table('respuestas')->where('user_id', $cedula)->where('ciclo', $ciclos)->where('tipo', '=', 'autoevaluacion')
            ->count();
        $tic2 = \DB::table('respuestas')->select('resultado')->where('user_id', $cedula)->where('ciclo', $ciclos)->where('categoria', 1)
            ->where('tipo', '=', 'autoevaluacion')->get();
        $tic_count = \DB::table('respuestas')->select('resultado')->where('user_id', $cedula)->where('ciclo', $ciclos)->where('categoria', 1)
            ->where('tipo', '=', 'autoevaluacion')->count();
        $peda2 = \DB::table('respuestas')->select('resultado')->where('user_id', $cedula)->where('ciclo', $ciclos)->where('categoria', 2)
            ->where('tipo', '=', 'autoevaluacion')->get();
        $peda_count = \DB::table('respuestas')->select('resultado')->where('user_id', $cedula)->where('ciclo', $ciclos)->where('categoria', 2)
            ->where('tipo', '=', 'autoevaluacion')->count();
        $dida2 = \DB::table('respuestas')->select('resultado')->where('user_id', $cedula)->where('ciclo', $ciclos)->where('categoria', 3)
            ->where('tipo', '=', 'autoevaluacion')->get();
        $dida_count = \DB::table('respuestas')->select('resultado')->where('user_id', $cedula)->where('ciclo', $ciclos)->where('categoria', 3)
            ->where('tipo', '=', 'autoevaluacion')->count();

        //arrays autoevaluacion
        $pedagogico = array();
        $pregunta_peda = array();
        $didactica = array();
        $pregunta_dida = array();
        $tics = array();
        $pregunta_tics = array();

        //arrays coevaluacion
        $pedagogico_coe = array();
        $pregunta_peda_coe = array();
        $didactica_coe = array();
        $pregunta_dida_coe = array();
        $tics_coe = array();
        $pregunta_tics_coe = array();



        /////////////////////////////////////////////////////////////////////////////////////////
        //calculo de los resultados autoevaluacion de TICS
        if ($conta_auto != null) {

            $resultado_auto_tic = 0;
            $contador_preguntas = 0;

            $j = 1;

            for ($i = 0; $i < $tic_count; $i++) {
                $tics[$i] = $tic2[$i]->resultado;
                if ($tic2[$i]->resultado == 1) {
                    $tics[$i] = 0;
                } elseif ($tic2[$i]->resultado == 2) {
                    $tics[$i] = 0.50;
                } elseif ($tic2[$i]->resultado == 3) {
                    $tics[$i] = 0.75;
                } elseif ($tic2[$i]->resultado == 4) {
                    $tics[$i] = 1;
                }
                $pregunta_tics[$i] = 'Pregunta ' . $j;
                $j++;
            }

            foreach ($tic2 as $ti) {
                if ($ti->resultado == 1) {
                    $resultado_auto_tic = $resultado_auto_tic + 0;
                    $contador_preguntas = $contador_preguntas + 1;
                } elseif ($ti->resultado == 2) {
                    $resultado_auto_tic = $resultado_auto_tic + 0.5;
                    $contador_preguntas = $contador_preguntas + 1;
                } elseif ($ti->resultado == 3) {
                    $resultado_auto_tic = $resultado_auto_tic + 0.75;
                    $contador_preguntas = $contador_preguntas + 1;
                } elseif ($ti->resultado == 4) {
                    $resultado_auto_tic = $resultado_auto_tic + 1;
                    $contador_preguntas = $contador_preguntas + 1;
                }
            }
            $resultado_auto_tic = ($resultado_auto_tic / $contador_preguntas) * 100;
            $resultado_auto_tic = round($resultado_auto_tic, 2);

            //calculo de los resultados autoevaluacion de Pedagogicos
            $resultado_auto_peda = 0;
            $contador_preguntas = 0;
            $j = 1;

            for ($i = 0; $i < $peda_count; $i++) {
                $pedagogico[$i] = $peda2[$i]->resultado;
                if ($peda2[$i]->resultado == 1) {
                    $pedagogico[$i] = 0;
                } elseif ($peda2[$i]->resultado == 2) {
                    $pedagogico[$i] = 0.50;
                } elseif ($peda2[$i]->resultado == 3) {
                    $pedagogico[$i] = 0.75;
                } elseif ($peda2[$i]->resultado == 4) {
                    $pedagogico[$i] = 1;
                }
                $pregunta_peda[$i] = 'Pregunta ' . $j;
                $j++;
            }

            foreach ($peda2 as $pe) {
                if ($pe->resultado == 1) {
                    $resultado_auto_peda = $resultado_auto_peda + 0;
                    $contador_preguntas = $contador_preguntas + 1;
                } elseif ($pe->resultado == 2) {
                    $resultado_auto_peda = $resultado_auto_peda + 0.5;
                    $contador_preguntas = $contador_preguntas + 1;
                } elseif ($pe->resultado == 3) {
                    $resultado_auto_peda = $resultado_auto_peda + 0.75;
                    $contador_preguntas = $contador_preguntas + 1;
                } elseif ($pe->resultado == 4) {
                    $resultado_auto_peda = $resultado_auto_peda + 1;
                    $contador_preguntas = $contador_preguntas + 1;
                }
            }
            $resultado_auto_peda = ($resultado_auto_peda / $contador_preguntas) * 100;
            $resultado_auto_peda = round($resultado_auto_peda, 2);

            //calculo de los resultados autoevaluacion de Didacticas
            $resultado_auto_dida = 0;
            $contador_preguntas = 0;

            $j = 1;

            for ($i = 0; $i < $dida_count; $i++) {
                $didactica[$i] = $dida2[$i]->resultado;
                if ($dida2[$i]->resultado == 1) {
                    $didactica[$i] = 0;
                } elseif ($dida2[$i]->resultado == 2) {
                    $didactica[$i] = 0.50;
                } elseif ($dida2[$i]->resultado == 3) {
                    $didactica[$i] = 0.75;
                } elseif ($dida2[$i]->resultado == 4) {
                    $didactica[$i] = 1;
                }
                $pregunta_dida[$i] = 'Pregunta ' . $j;
                $j++;
            }

            foreach ($dida2 as $di) {
                if ($di->resultado == 1) {
                    $resultado_auto_dida = $resultado_auto_dida + 0;
                    $contador_preguntas = $contador_preguntas + 1;
                } elseif ($di->resultado == 2) {
                    $resultado_auto_dida = $resultado_auto_dida + 0.5;
                    $contador_preguntas = $contador_preguntas + 1;
                } elseif ($di->resultado == 3) {
                    $resultado_auto_dida = $resultado_auto_dida + 0.75;
                    $contador_preguntas = $contador_preguntas + 1;
                } elseif ($di->resultado == 4) {
                    $resultado_auto_dida = $resultado_auto_dida + 1;
                    $contador_preguntas = $contador_preguntas + 1;
                }
            }
            $resultado_auto_dida = ($resultado_auto_dida / $contador_preguntas) * 100;
            $resultado_auto_dida = round($resultado_auto_dida, 2);

            //Calculo de la nota global autoevaluacion
            $total_auto  = ($resultado_auto_dida + $resultado_auto_peda + $resultado_auto_tic) / 3;
            $total_auto = round($total_auto, 2);
        } else {
            $resultado_auto_dida = 'No existen resultados';
            $resultado_auto_peda = 'No existen resultados';
            $resultado_auto_tic = 'No existen resultados';
        }

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //calculo de los resultados coevaluacion de TICS
        if ($conta_coe != null) {
            $resultado_coe_tic = 0;
            $contador_preguntas = 0;

            $j = 1;

            for ($i = 0; $i < $tic_count_coe; $i++) {
                $tics_coe[$i] = $tic[$i]->resultado;
                if ($tic[$i]->resultado == 1) {
                    $tics_coe[$i] = 0;
                } elseif ($tic[$i]->resultado == 2) {
                    $tics_coe[$i] = 0.50;
                } elseif ($tic[$i]->resultado == 3) {
                    $tics_coe[$i] = 0.75;
                } elseif ($tic[$i]->resultado == 4) {
                    $tics_coe[$i] = 1;
                }
                $pregunta_tics_coe[$i] = 'Pregunta ' . $j;
                $j++;
            }

            foreach ($tic as $ti) {
                if ($ti->resultado == 1) {
                    $resultado_coe_tic = $resultado_coe_tic + 0;
                    $contador_preguntas = $contador_preguntas + 1;
                } elseif ($ti->resultado == 2) {
                    $resultado_coe_tic = $resultado_coe_tic + 0.5;
                    $contador_preguntas = $contador_preguntas + 1;
                } elseif ($ti->resultado == 3) {
                    $resultado_coe_tic = $resultado_coe_tic + 0.75;
                    $contador_preguntas = $contador_preguntas + 1;
                } elseif ($ti->resultado == 4) {
                    $resultado_coe_tic = $resultado_coe_tic + 1;
                    $contador_preguntas = $contador_preguntas + 1;
                }
            }
            $resultado_coe_tic = ($resultado_coe_tic / $contador_preguntas) * 100;
            $resultado_coe_tic = round($resultado_coe_tic, 2);

            //calculo de los resultados coevaluacion de Pedagogicos
            $resultado_coe_peda = 0;
            $contador_preguntas = 0;

            $j = 1;

            for ($i = 0; $i < $peda_count_coe; $i++) {
                $pedagogico_coe[$i] = $peda[$i]->resultado;
                if ($peda[$i]->resultado == 1) {
                    $pedagogico_coe[$i] = 0;
                } elseif ($peda[$i]->resultado == 2) {
                    $pedagogico_coe[$i] = 0.50;
                } elseif ($peda[$i]->resultado == 3) {
                    $pedagogico_coe[$i] = 0.75;
                } elseif ($peda[$i]->resultado == 4) {
                    $pedagogico_coe[$i] = 1;
                }
                $pregunta_peda_coe[$i] = 'Pregunta ' . $j;
                $j++;
            }

            foreach ($peda as $pe) {
                if ($pe->resultado == 1) {
                    $resultado_coe_peda = $resultado_coe_peda + 0;
                    $contador_preguntas = $contador_preguntas + 1;
                } elseif ($pe->resultado == 2) {
                    $resultado_coe_peda = $resultado_coe_peda + 0.5;
                    $contador_preguntas = $contador_preguntas + 1;
                } elseif ($pe->resultado == 3) {
                    $resultado_coe_peda = $resultado_coe_peda + 0.75;
                    $contador_preguntas = $contador_preguntas + 1;
                } elseif ($pe->resultado == 4) {
                    $resultado_coe_peda = $resultado_coe_peda + 1;
                    $contador_preguntas = $contador_preguntas + 1;
                }
            }
            $resultado_coe_peda = ($resultado_coe_peda / $contador_preguntas) * 100;
            $resultado_coe_peda = round($resultado_coe_peda, 2);

            //calculo de los resultados coevaluacion de Didacticas
            $resultado_coe_dida = 0;
            $contador_preguntas = 0;

            $j = 1;

            for ($i = 0; $i < $dida_count_coe; $i++) {
                $didactica_coe[$i] = $dida[$i]->resultado;
                if ($dida[$i]->resultado == 1) {
                    $didactica_coe[$i] = 0;
                } elseif ($dida[$i]->resultado == 2) {
                    $didactica_coe[$i] = 0.50;
                } elseif ($dida[$i]->resultado == 3) {
                    $didactica_coe[$i] = 0.75;
                } elseif ($dida[$i]->resultado == 4) {
                    $didactica_coe[$i] = 1;
                }
                $pregunta_dida_coe[$i] = 'Pregunta ' . $j;
                $j++;
            }

            foreach ($dida as $di) {
                if ($di->resultado == 1) {
                    $resultado_coe_dida = $resultado_coe_dida + 0;
                    $contador_preguntas = $contador_preguntas + 1;
                } elseif ($di->resultado == 2) {
                    $resultado_coe_dida = $resultado_coe_dida + 0.5;
                    $contador_preguntas = $contador_preguntas + 1;
                } elseif ($di->resultado == 3) {
                    $resultado_coe_dida = $resultado_coe_dida + 0.75;
                    $contador_preguntas = $contador_preguntas + 1;
                } elseif ($di->resultado == 4) {
                    $resultado_coe_dida = $resultado_coe_dida + 1;
                    $contador_preguntas = $contador_preguntas + 1;
                }
            }
            $resultado_coe_dida = ($resultado_coe_dida / $contador_preguntas) * 100;
            $resultado_coe_dida = round($resultado_coe_dida, 2);

            //Calculo de la nota global coevaluacion
            $total_coe  = ($resultado_coe_dida + $resultado_coe_peda + $resultado_coe_tic) / 3;
            $total_coe = round($total_coe, 2);
        } else {
            $resultado_coe_dida = 'No existen resultados';
            $resultado_coe_peda = 'No existen resultados';
            $resultado_coe_tic = 'No existen resultados';
        }
        $semaforo_verde = 'Imagenes\semaforo_verde.png';
        $semaforo_amarillo = 'Imagenes\semaforo_amarillo.png';
        $semaforo_rojo = 'Imagenes\semaforo_rojo.png';
        $observaciones = \DB::table('respuestas')->select('observaciones')->where('user_id', $cedula)
            ->where('materia', '=', $mate)->where('ciclo', '=', $ciclos)->get();
        //return $mate;



        return view('resultados',  compact(
            'id',
            'name',
            'cedula',
            'email',
            'imagen',
            'ciclo',
            'ciclos',
            'ci',
            'res',
            'tic',
            'peda',
            'dida',
            'res2',
            'tic2',
            'peda2',
            'dida2',
            'resultado_auto_tic',
            'resultado_auto_peda',
            'resultado_auto_dida',
            'resultado_coe_tic',
            'resultado_coe_peda',
            'resultado_coe_dida',
            'pedagogico',
            'pregunta_peda',
            'didactica',
            'pregunta_dida',
            'tics',
            'pregunta_tics',
            'pedagogico_coe',
            'pregunta_peda_coe',
            'didactica_coe',
            'pregunta_dida_coe',
            'tics_coe',
            'pregunta_tics_coe',
            'semaforo_verde',
            'semaforo_amarillo',
            'semaforo_rojo',
            'conta_auto',
            'conta_coe',
            'total_coe',
            'total_auto',
            'materias',
            'mate',
            'observaciones'
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
