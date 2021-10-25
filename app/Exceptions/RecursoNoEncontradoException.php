<?php


namespace App\Exceptions;


class RecursoNoEncontradoException extends \Exception
{

    public function report()
    {
        //
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request)
    {
        return response()->json("El recurso buscado no existe", 404);
    }
}
