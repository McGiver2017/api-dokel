<?php

namespace App\Http\Controllers\BusquedaPersonalidas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Office;
use App\Enterprise;
use App\Account;
use Tecactus\Sunat\RUC;
use Tecactus\Reniec\DNI;
use App\Http\Resources\Office\ComboOfficeResource;
use App\Http\Resources\Office\DatosOfficeResource;
class BuscarEmpresaController extends Controller
{
    public $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjE2ZTQ0ZGI5Y2ExZjdmOGU2M2MzMmU2MTM5NTVmNTg5ZGZmZDM1NDVhYzYwODA1NTc3YjBlODM0ZjkwZWNmMzJjYzM5ODRjMWRjY2RjNzY1In0.eyJhdWQiOiIxIiwianRpIjoiMTZlNDRkYjljYTFmN2Y4ZTYzYzMyZTYxMzk1NWY1ODlkZmZkMzU0NWFjNjA4MDU1NzdiMGU4MzRmOTBlY2YzMmNjMzk4NGMxZGNjZGM3NjUiLCJpYXQiOjE1MjYzOTA3ODEsIm5iZiI6MTUyNjM5MDc4MSwiZXhwIjoxNTU3OTI2NzgxLCJzdWIiOiIxMjgxIiwic2NvcGVzIjpbInVzZS1yZW5pZWMiLCJ1c2Utc3VuYXQiXX0.wz0Q33-aqZL759rs_3o2xW8ZV8U_eqHhT43WjaOYO-ldoFruI4aPxrstjJEROxW1kwbiFzj1YjZRpHp6YLFY5LWuyeMolUHmKc-uwT6Xs6vhwBQCA6eoRyLlOQhye4LkCzq6R7DBiwanzWq0Ztp9LjbH0UhAhH5NTouVuFaDecYnf0QqpjptIy37dwvuWTCjAeo9nPgL4Es4puUEL9zvItpYV-ySzh3DPUYfFnsA8OK_5PBOw_bbdxRuZFaHS1hkZWhK1T4Om_MFNnoqbBlXzuM2Hy2hZ4kvu8IhmgIE7u5nkrmDhc6k1d2H_G_a_Fic6VqRO3fuGCblGqzRFIBGEHXBIUF35XdFSghLqVqZCsoC6iqvoZIJV9BNCLu5a8RDniBzBBcfGnIrCaWqpbbR-fnqbM1WHVKt4A-W_YvgAn0fJtJVUqvZG9Jcxpp049r1S7mdl1r6horP3F5Pw7IE3ofr5nxZOgNOwmz13UEu9yU48m6597xOZQMGQb4a1nnGOlS5xoOA-MPriTRsXdsE7b9WUoBJYlTbkNo96Ud6TNC4oLU71h7JOCWORz9jgEs4zdDn2X9wspaQi-ofAptSTuhgVasFOgoXPFU6_QtOQl9RCFGL5TzDYWC30iHC2l1XTG5hAzIfvhDG67UY0n4Oes85XZ3JMNqQJdDZ_Wu2Q2U';
    public function buscarPorRuc ($doc) {
        $empresa = Enterprise::where('ruc', $doc)->first();
        if ($empresa) {
            $datos = Office::where('enterprise_id', $empresa->id)->get();
            return response()->json(['empresa' => $empresa, 'combo' => ComboOfficeResource::collection($datos)]);
        }
        else{
            if (strlen($doc) <= 8) {
                $reniecDni = new DNI($this->token);
                return response()->json(['data' => $reniecDni->get($doc, true)]);
            }
            else {
                $sunatRuc = new RUC('eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjEzODRkOTQ5M2Y4NzU4YTFjZTVmZTEwMjUzYjMyMTlkODI2ODI0ZjRiMTlmY2YyYmRjZjQxNGExOWIyNDc2ZmI1MDY4MzBjODM5NWYwOTBkIn0.eyJhdWQiOiIxIiwianRpIjoiMTM4NGQ5NDkzZjg3NThhMWNlNWZlMTAyNTNiMzIxOWQ4MjY4MjRmNGIxOWZjZjJiZGNmNDE0YTE5YjI0NzZmYjUwNjgzMGM4Mzk1ZjA5MGQiLCJpYXQiOjE1MTc0NTc4NDEsIm5iZiI6MTUxNzQ1Nzg0MSwiZXhwIjoxNTQ4OTkzODQxLCJzdWIiOiIxMzI3Iiwic2NvcGVzIjpbInVzZS1zdW5hdCJdfQ.v3mwrPtN-kdJY3kI3uphqRpuTXFDLiJLvBFg-lwsGSteHlg250eswI00s6UB5dCMYyRiWNr2d39-M9A51b8JKwN6X09rQNdURCgb6ZfOpCNw4Pi3Vpyw1_CvzznLMJTlihRViLj7bvJkvrzIujpWzriUXuFCjG7qq9_kKOscbQDnJu9O_zgyRi_b2kSJiqel-kQABdSD6iaLDvHawibHAIe86s304pRicYcafsxqdXgZXi2q4_3-5RaKcSlyc8ut5oQahosFLNmMEM-STIlU5eavl8L17blUbQwcs1kAIThw-pBqKqqOE0IGhlWyhZsUiAmmGBQYIaT_77GfY5ndD_gO5t7836OQu1dOLp3q_0ZPYMIlqIMW76ND7qdORTeZsd5KI0YTtxpUvVkYI15XZ-B6WAQ4GmBBQbH0JB1LzqO7Y0-E1cjTm1HQw6KXyKjDji9FivOjKb8YM9GHKVzvKMKuKWcHznR1eunax4hqLlSsELamroiKOyVBDXHq_xvwI3iMoninNSAtHKsmRpebgfNRTicoHtkJ5b_XsmCzwUpbvc82pHyGbGdVZvNWfO13icKvuQQMaCr7JGD_6Bp0sxHvlvlDXq03oTNcalgWd0Ei542YQ73AukVvE1UsMzUyfbXctFLTC6VLajFUFgmj_fWHY2C0mEhoapO9xwRQDTM');
                return response($sunatRuc->getByRuc($doc, true))
                ->withHeaders([
                    'Content-Type' => 'text/json',
                ]);
            }
        }
        
    }
    public function buscarDni ($doc) {
        $reniecDni = Tecactus\Reniec\DNI($this->token);
        return response()->json(['data' => $reniecDni->get($doc, true)]);
    }
    public function buscarRuc ($doc) {
        $sunatRuc = new Tecactus\Sunat\RUC($this->token);
        //$sunatRuc->getByDni('12345678')
        //$sunatRuc->getByRuc($doc, true)
        return response()->json(['data' => $sunatRuc->getByRuc($doc, true)]);
    }
    public function obtenerSerie (Request $request) {
        $usuario = auth()->user();
        $oficina = $request->oficina;
        if($oficina==null){
            $cuenta = Account::where('user_id', $usuario->id)->first();
            $oficina = Office::where('enterprise_id', $cuenta->enterprise_id)->first();
            return new DatosOfficeResource($oficina);
        }
        $oficina = Office::where('id', $oficina)->first();
        return new DatosOfficeResource($oficina);
    }
}
