<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\User;
use App\materia;

class PdfController extends Controller
{
    public function PDF(Request $request)
    {
        $cedula = auth()->user()->cedula;
        $ciclos = $request->ciclo;
        $mate = $request->materia;
        //Resultados Autoevaluacion 
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

        //Resultados Coevaluacion
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

        $coevaluador = \DB::table('respuestas')->select('coevaluador')->where('user_id', $cedula)->where('ciclo', $ciclos)->where('categoria', 2)
            ->where('tipo', '=', 'coevaluacion')->where('materia', '=', $mate)->get();
        $docente_coe = null;
        foreach ($coevaluador as $coevaluado) {
            $docente_coe = $coevaluado->coevaluador;
        }

        $docente_coe = User::where('cedula', $docente_coe)->first();
        if ($docente_coe != null) {
            $docente_coe_na = $docente_coe->name;
            $docente_coe_ape = $docente_coe->apellido;
        }else {
            $docente_coe_na = null;
            $docente_coe_ape = null;
        }

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


        $total_auto = $request->total_auto;
        $total_coe = $request->total_coe;

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
        } else {
            $resultado_coe_dida = null;
            $resultado_coe_peda = null;
            $resultado_coe_tic = null;
        }

        $nombre_pdf = User::select('name')->where('cedula', $cedula)->first();
        $apellido_pdf = User::select('apellido')->where('cedula', $cedula)->first();

        $nombre_pdf = $nombre_pdf->name;
        $apellido_pdf = $apellido_pdf->apellido;


        $user = User::where('cedula', $cedula)->first();
        $pdf = PDF::loadView('prueba', compact(
            'user',
            'ciclos',
            'total_auto',
            'resultado_auto_peda',
            'resultado_coe_peda',
            'pregunta_peda',
            'pedagogico',
            'didactica',
            'resultado_auto_dida',
            'resultado_coe_dida',
            'resultado_auto_tic',
            'resultado_coe_tic',
            'tics',
            'total_coe',
            'mate',
            'docente_coe_na',
            'docente_coe_ape',
            'pedagogico_coe',
            'didactica_coe',
            'tics_coe'
        ));
        return $pdf->download("$apellido_pdf $nombre_pdf resultados.pdf");
    }
}
