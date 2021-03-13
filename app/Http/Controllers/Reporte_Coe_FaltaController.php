<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\User;
use App\materia;


class Reporte_Coe_FaltaController extends Controller
{
    public function reporte_coe_falta(Request $request)
    {
        $docentes = \DB::select('select * from users ORDER BY apellido');
        $compro = \DB::select('select * from comprobaciones');

        $pdf = PDF::loadView('reporte_coe_falta', compact('docentes', 'compro'));
        return $pdf->download("Reporte_Coevaluación.pdf");

    }
}
