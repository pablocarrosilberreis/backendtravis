<?php

namespace App\Http\Controllers\API\Publicacion;

use App\Http\Controllers\Controller;
use App\Models\Entities\Publicaciones\Estado;
use App\Models\Repositories\RepositorioDeEstados;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

//TODO: Completar Estado
class EstadosController extends Controller
{
    private RepositorioDeEstados $repositorioDeEstados;

    public function __construct(RepositorioDeEstados $repositorioDeEstados)
    {
        $this->repositorioDeEstados = $repositorioDeEstados;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\RecursoNoEncontradoException
     */
    public function index()
    {
        $estados = $this->repositorioDeEstados->findAll();
        return parent::respuestaJson($estados);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\RecursoNoEncontradoException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function store(Request $request)
    {
        $estado = new Estado();
        $this->asignarParametros($estado, $request);
        $this->repositorioDeEstados->entityManager()->persist($estado);
        $this->repositorioDeEstados->entityManager()->flush();
        return parent::respuestaJson($estado);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\RecursoNoEncontradoException
     */
    public function show($id)
    {
        $estado = $this->repositorioDeEstados->find($id);
        return parent::respuestaJson($estado);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\RecursoNoEncontradoException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(Request $request, $id)
    {
        $estado = $this->repositorioDeEstados->find($id);
        $this->asignarParametros($estado, $request);
        $this->repositorioDeEstados->entityManager()->persist($estado);
        $this->repositorioDeEstados->entityManager()->flush();
        return parent::respuestaJson($estado);
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

    private function asignarParametros(Estado $estado, $parametros)
    {
        $estado->setNombre($parametros['nombre']);
    }
}
