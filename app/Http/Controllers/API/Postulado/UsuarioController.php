<?php

namespace App\Http\Controllers\API\Postulado;

use App\Http\Controllers\Controller;
use App\Models\Entities\Postulados\Usuario;
use App\Models\Repositories\RepositorioDeUsuarios;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Nette\Utils\DateTime;

//TODO: Completar Usuario
class UsuarioController extends Controller
{
    private RepositorioDeUsuarios $repositorioDeUsuarios;

    public function __construct(RepositorioDeUsuarios $repositorioDeUsuarios)
    {
        $this->repositorioDeUsuarios = $repositorioDeUsuarios;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\RecursoNoEncontradoException
     */
    public function index()
    {
        $usuarios = $this->repositorioDeUsuarios->findAll();
        return parent::respuestaJson($usuarios);
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
        $usuario = new Usuario();
        $this->asignarParametros($usuario, $request);
        $this->repositorioDeUsuarios->entityManager()->persist($usuario);
        $this->repositorioDeUsuarios->entityManager()->flush();
        return parent::respuestaJson($usuario);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\RecursoNoEncontradoException
     */
    public function show($id)
    {
        $usuario = $this->repositorioDeUsuarios->find($id);
        return parent::respuestaJson($usuario);
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
        $usuario = $this->repositorioDeUsuarios->find($id);
        $this->asignarParametros($usuario, $request);
        $this->repositorioDeUsuarios->entityManager()->persist($usuario);
        $this->repositorioDeUsuarios->entityManager()->flush();
        return parent::respuestaJson($usuario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = $this->repositorioDeUsuarios->find($id);
        $usuario->desactivar();
        $this->repositorioDeUsuarios->entityManager()->persist($usuario);
        $this->repositorioDeUsuarios->entityManager()->flush();
    }

    private function asignarParametros(Usuario $usuario, $parametros)
    {
        $usuario->activar();
        $usuario->setUsuarioExterno($parametros['usuario_externo']);
        $usuario->setUltimaConexion(new \DateTime('now'));
    }
}
