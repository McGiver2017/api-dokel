<?php

namespace App\Http\Controllers\Enterprise\Office;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Office as modelTable;
use App\leyend_office;
class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $crear = modelTable::create($request->all());
        $id = $crear->id;
        $amazonia = [
            [
                'office_id' => $id,
                'leyend_code' => '1000'
            ],
            [
                'office_id' => $id,
                'leyend_code' => '2001'
            ],
            [
                'office_id' => $id,
                'leyend_code' => '2002'
            ]
        ];
        foreach ($amazonia as $fila) {
            leyend_office::create($fila);
        }
        return response()->json(['data' => $crear]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['data' => modelTable::find($id)]);
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
        $fila = modelTable::findOrFail($id);
        if ($request->has('enterprise_id')){
            $fila->enterprise_id = $request->enterprise_id;
        }
        if ($request->has('direction')){
            $fila->direction = $request->direction;
        }
        if ($request->has('cod_postal')){
            $fila->cod_postal = $request->cod_postal;
        }
        if ($request->has('departament')){
            $fila->departament = $request->departament;
        }
        if ($request->has('province')){
            $fila->province = $request->province;
        }
        if ($request->has('district')){
            $fila->district = $request->district;
        }
        $actualizar = $fila->save();
        return response()->json(['data' => $actualizar]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $eliminar = modelTable::destroy($id);
           return response()->json(['data' => 'eliminado']);
        }
        catch (Exception $e) {
            return response()->json(['data' => ['mensaje' => 'No se puede Elimnar']], 400);
        }   
    }
}
