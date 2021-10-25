<?php

namespace App\Http\Controllers\API\Ubicacion;

use App\Http\Controllers\Controller;
use App\Models\Repositories\RepositorioDePaises;
use Illuminate\Http\Request;

class PaisesController extends Controller
{
    private RepositorioDePaises $repositorioDePaises;

    /**
     * PaisesController constructor.
     * @param RepositorioDePaises $repositorioDePaises
     */
    public function __construct(RepositorioDePaises $repositorioDePaises)
    {
        $this->repositorioDePaises = $repositorioDePaises;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $paises = $this->repositorioDePaises->findAll();
        return parent::respuestaJson($paises);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $pais = $this->repositorioDePaises->find($id);
        return parent::respuestaJson($pais);
    }
}
