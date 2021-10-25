<?php

namespace App\Http\Controllers\API\Publicacion;

use App\Http\Controllers\Controller;
use App\Models\Repositories\RepositorioDePublicacionModalidadesContratos;
use Illuminate\Http\Request;

//TODO: Completar PublicacionModalidadContrato
class PublicacionModalidadesContratosController extends Controller
{
    private RepositorioDePublicacionModalidadesContratos $repositorioDePublicacionModalidadesContratos;

    public function __construct(RepositorioDePublicacionModalidadesContratos $repositorioDePublicacionModalidadesContratos)
    {
        $this->repositorioDePublicacionModalidadesContratos = $repositorioDePublicacionModalidadesContratos;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\RecursoNoEncontradoException
     */
    public function index()
    {
        $modalidadesContratos = $this->repositorioDePublicacionModalidadesContratos->findAll();
        return parent::respuestaJson($modalidadesContratos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\RecursoNoEncontradoException
     */
    public function show($id)
    {
        $modalidadContrato = $this->repositorioDePublicacionModalidadesContratos->find($id);
        return parent::respuestaJson($modalidadContrato);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
