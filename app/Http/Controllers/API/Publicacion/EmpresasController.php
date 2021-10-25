<?php

namespace App\Http\Controllers\API\Publicacion;

use App\Http\Controllers\Controller;
use App\Models\Entities\Publicaciones\Empresa;
use App\Models\Repositories\RepositoriodeEmpresas;
use Illuminate\Http\Request;

//TODO: Completar Empresa
class EmpresasController extends Controller
{
    private RepositoriodeEmpresas $repositoriodeEmpresas;

    /**
     * @param RepositoriodeEmpresas $repositoriodeEmpresas
     */
    public function __construct(RepositoriodeEmpresas $repositoriodeEmpresas)
    {
        $this->repositoriodeEmpresas = $repositoriodeEmpresas;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\RecursoNoEncontradoException
     */
    public function index()
    {
        $empresas = $this->repositoriodeEmpresas->findAll();
        return parent::respuestaJson($empresas);
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
        $empresa = new Empresa();
        $this->asignarParametros($empresa, $request);
        $this->repositoriodeEmpresas->entityManager()->persist($empresa);
        $this->repositoriodeEmpresas->entityManager()->flush();
        return parent::respuestaJson($empresa);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\RecursoNoEncontradoException
     */
    public function show($id)
    {
        $empresa = $this->repositoriodeEmpresas->find($id);
        return parent::respuestaJson($empresa);
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
        $empresa = $this->repositoriodeEmpresas->find($id);
        $this->asignarParametros($empresa, $request);
        $this->repositoriodeEmpresas->entityManager()->persist($empresa);
        $this->repositoriodeEmpresas->entityManager()->flush();
        return parent::respuestaJson($empresa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empresa = $this->repositoriodeEmpresas->find($id);
        $empresa->desactivar();
        $this->repositoriodeEmpresas->entityManager()->persist($empresa);
        $this->repositoriodeEmpresas->entityManager()->flush();
    }

    private function asignarParametros(Empresa $empresa, $parametros)
    {
        $empresa->setNombre($parametros['nombre']);
        $empresa->setDescripcion($parametros['descripcion']);
        $empresa->activar();
    }
}
