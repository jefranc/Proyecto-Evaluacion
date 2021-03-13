<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\User;
use App\materia;


class Reporte_AutoController extends Controller
{
    public function reporte_auto(Request $request)
    {
        $user = \DB::select('select * from users ORDER BY apellido');


        $pdf = PDF::loadView('reporte_auto', compact('user'));
        return $pdf->download("Reporte_Autoevaluación.pdf");

    }
}
