<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\User;
use App\materia;

class Reporte_Auto_FaltaController extends Controller
{
    public function reporte_auto_falta(Request $request)
    {
        $user = \DB::select('select * from users ORDER BY apellido');


        $pdf = PDF::loadView('reporte_auto_falta', compact('user'));
        return $pdf->download("Reporte_Autoevaluación.pdf");

    }
}
