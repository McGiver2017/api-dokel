<?php

namespace App\Http\Controllers\TipoDocumentos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class tipodocumentosController extends Controller
{
    public function generarDatos() {
        $datos = [
                ['code' => '01','description' => 'FACTURA', 'UN 1001-Document Name' => '380'],
                ['code' => '03','description' => 'FACTURA', 'UN 1001-Document Name' => '346'],
                ['code' => '07','description' => 'FACTURA', 'UN 1001-Document Name' => '381'],
                ['code' => '08','description' => 'FACTURA', 'UN 1001-Document Name' => '383'],
                ['code' => '09','description' => 'FACTURA'],
                ['code' => '12','description' => 'FACTURA'],
                ['code' => '13','description' => 'FACTURA'],
                ['code' => '14','description' => 'FACTURA'],
                ['code' => '18','description' => 'FACTURA'],
                ['code' => '31','description' => 'FACTURA'],
                ['code' => '56','description' => 'FACTURA'],
                ['code' => '71','description' => 'FACTURA'],                
                ['code' => '72','description' => 'FACTURA'],
            ];
    }
    public function index()
    {
        //
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
