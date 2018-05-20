<?php

namespace App\Http\Controllers\DocumentsElectronics\Consultas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Enterprise;
class RucDNI extends Controller
{
    public function consultarDocumentoIdentidad($documento){
        $empresa = Enterprise::where('ruc', $documento)->first();
        return $empresa;
    }
}
