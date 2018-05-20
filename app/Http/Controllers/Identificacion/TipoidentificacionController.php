<?php

namespace App\Http\Controllers\Identificacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Identification as modelTable;
class TipoidentificacionController extends Controller
{/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data' => modelTable::all()]);
    }
    public function store(Request $request)
    {
        $crear = modelTable::create($request->all());
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fila = modelTable::findOrFail($id);
        if ($request->has('code')){
            $fila->code = $request->code;
        }
        if ($request->has('description')){
            $fila->description = $request->description;
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
