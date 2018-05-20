<?php

namespace App\Http\Controllers\Serie;

use App\Serie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpParser\Node\Stmt\TryCatch;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data' => Serie::all()]);
    }
    public function store(Request $request)
    {
        $crear = Serie::create($request->all());
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
        return response()->json(['data' => Serie::find($id)]);
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
        $serie = Serie::findOrFail($id);
        if ($request->has('serie')){
            $serie->serie = $request->serie;
        }
        if ($request->has('type_document')){
            $serie->type_document = $request->type_document;
        }
        if ($request->has('code_type_document')){
            $serie->code_type_document = $request->code_type_document;
        }
        if ($request->has('first')){
            $serie->first = $request->first;
        }
        $actualizar = $serie->save();
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
            $eliminar = Serie::destroy($id);
           return response()->json(['data' => 'eliminado']);
        }
        catch (Exception $e) {
            return response()->json(['data' => ['mensaje' => 'No se puede Elimnar']], 400);
        }        
    }
}
