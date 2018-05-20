<?php

namespace App\Http\Controllers\Enterprise;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Enterprise as modelTable;
use App\Office;
use App\Http\Resources\Empresa\EmpresaResource;
class EnterpriseController extends Controller
{
    public function index()
    {
        return EmpresaResource::collection(modelTable::all());
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
        return response()->json(['data' => Office::where('enterprise_id', $id)->get()]);
    }
    public function edit($id)
    {
        return response()->json(['data' => modelTable::find($id)]);
    }
    public function update(Request $request, $id)
    {
        $fila = modelTable::findOrFail($id);
        if ($request->has('identification_code')){
            $fila->identification_code = $request->identification_code;
        }
        if ($request->has('ruc')){
            $fila->ruc = $request->ruc;
        }
        if ($request->has('comertial_name')){
            $fila->comertial_name = $request->comertial_name;
        }
        if ($request->has('razon_social')){
            $fila->razon_social = $request->razon_social;
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
