<?php

namespace App\Http\Controllers;

use App\Exceptions\RecursoNoEncontradoException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function respuestaJson($entidad, int $codigoDeEstado = 200) {
        if(is_null($entidad)) throw new RecursoNoEncontradoException();
        return response()->json($entidad, $codigoDeEstado, [], JSON_UNESCAPED_UNICODE);
    }
}
