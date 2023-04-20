<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Venta;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $detallecompras, $detalleventas;
    public function index()
    {
        //
        $f1=date("Y-m-d");
        $f2=date("Y-m-d");
        $detalleventas = Venta::latest()
        ->whereBetween('fecha', [$f1, $f2])
        ->get();
        $detallecompras = Compra::latest()
        ->whereBetween('fecha', [$f1, $f2])
        ->get();
        return view('reportes.resumen',compact('detalleventas','detallecompras','f1','f2'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function actualiza(Request $request)
    {
        //
        $request->validate([
            'f1'=>'required',
            'f2'=>'required',
        ]);

        $f1=$request->f1;
        $f2=$request->f2;

        $detalleventas = Venta::latest()
        ->whereBetween('fecha', [$f1, $f2])
        ->get();
        $detallecompras = Compra::latest()
        ->whereBetween('fecha', [$f1, $f2])
        ->get();
        return view('reportes.resumen',compact('detalleventas','detallecompras','f1','f2'));


    }

    /**
     * Display the specified resource.
     */
    public function show(Reporte $reporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reporte $reporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reporte $reporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reporte $reporte)
    {
        //
    }
}
