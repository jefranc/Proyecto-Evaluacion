<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\User;
use App\materia;

class Reporte_CoeController extends Controller
{
    public function reporte_coe(Request $request)
    {
        $docentes = \DB::select('select * from users ORDER BY apellido');
        $compro = \DB::select('select * from comprobaciones');


        $pdf = PDF::loadView('reporte_coe', compact('docentes', 'compro'));
        return $pdf->download("Reporte_Coevaluación.pdf");

    }
}
