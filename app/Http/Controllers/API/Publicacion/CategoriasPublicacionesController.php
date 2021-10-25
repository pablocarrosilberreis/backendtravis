<?php

namespace App\Http\Controllers\API\Publicacion;

use App\Http\Controllers\Controller;
use App\Models\Entities\Publicaciones\PublicacionCategoria;
use App\Models\Repositories\RepositorioDeCategoriasDePublicaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriasPublicacionesController extends Controller
{
    private RepositorioDeCategoriasDePublicaciones $repositorioDeCategoriasDePublicaciones;

    /**
     * CategoriasPublicacionesController constructor.
     * @param RepositorioDeCategoriasDePublicaciones $repositorioDeCategoriasDePublicaciones
     */
    public function __construct(RepositorioDeCategoriasDePublicaciones $repositorioDeCategoriasDePublicaciones)
    {
        $this->repositorioDeCategoriasDePublicaciones = $repositorioDeCategoriasDePublicaciones;
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $publicacionesCategoria = $this->repositorioDeCategoriasDePublicaciones->findAll();
        return parent::respuestaJson($publicacionesCategoria);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function store(Request $request)
    {
        $this->validar($request);
        $publicacionCategoria = new PublicacionCategoria();
        $this->asignarParametros($publicacionCategoria, $request->all());
        $this->repositorioDeCategoriasDePublicaciones->entityManager()->persist($publicacionCategoria);
        $this->repositorioDeCategoriasDePublicaciones->entityManager()->flush();
        return parent::respuestaJson($publicacionCategoria);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $publicacionCategoria = $this->repositorioDeCategoriasDePublicaciones->find($id);
        return parent::respuestaJson($publicacionCategoria);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(Request $request, $id)
    {
        $this->validar($request);
        $publicacionCategoria = $this->repositorioDeCategoriasDePublicaciones->find($id);
        $this->asignarParametros($publicacionCategoria, $request->all());
        $this->repositorioDeCategoriasDePublicaciones->entityManager()->persist($publicacionCategoria);
        $this->repositorioDeCategoriasDePublicaciones->entityManager()->flush();
        return parent::respuestaJson($publicacionCategoria);
    }

    public function destroy($id)
    {
        $publicacionCategoria = $this->repositorioDeCategoriasDePublicaciones->find($id);
        $publicacionCategoria->desactivar();
        $this->repositorioDeCategoriasDePublicaciones->entityManager()->persist($publicacionCategoria);
        $this->repositorioDeCategoriasDePublicaciones->entityManager()->flush();
    }

    private function asignarParametros(PublicacionCategoria $publicacionCategoria, $parametros)
    {
        $publicacionCategoria->setNombre($parametros['nombre']);
    }

    private function validar(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'nombre' => 'required',
        ], [
            'required' => 'El campo :attribute es obligatorio'
        ]);

        $validador->validate();
    }
}
