<?php


namespace App\Exceptions;


class AccesoDenegadoException extends \Exception
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
        return response()->json('Acceso denegado', 401);
    }
}
