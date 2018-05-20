<?php

namespace App\Http\Controllers\SelectCombo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Identification;
use App\type_affectation_igv;
use App\Http\Resources\SelectCombo\IdentificationComboResource;
use App\Http\Resources\SelectCombo\TipIgvComboResource;
class SelectController extends Controller
{
    function obtenerCombo ($tabla) {
        switch ($tabla) {
            case 'identificacion':
                return IdentificationComboResource::collection(Identification::all());
                break;
            case 'tipoigv':
                return TipIgvComboResource::collection(type_affectation_igv::all());
                break;
            
            default:
                # code...
                break;
        }
    }
}
