<?php

namespace App\Http\Controllers\API\Ubicacion;

use App\Http\Controllers\Controller;
use App\Models\Repositories\RepositorioDePaises;
use App\Models\Repositories\RepositorioDeProvincias;
use Illuminate\Http\Request;

class ProvinciasController extends Controller
{
    private RepositorioDeProvincias $repositorioDeProvincias;
    private RepositorioDePaises $repositorioDePaises;

    /**
     * ProvinciasController constructor.
     * @param RepositorioDeProvincias $repositorioDeProvincias
     * @param RepositorioDePaises $repositorioDePaises
     */
    public function __construct(RepositorioDeProvincias $repositorioDeProvincias, RepositorioDePaises $repositorioDePaises)
    {
        $this->repositorioDeProvincias = $repositorioDeProvincias;
        $this->repositorioDePaises = $repositorioDePaises;
    }

    public function index($id)
    {
        $pais = $this->repositorioDePaises->find($id);
        $provincias = $this->repositorioDeProvincias->findBy([
            "pais" => $pais,
            "activo" => true,
        ]);

        return parent::respuestaJson($provincias);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $provincia = $this->repositorioDeProvincias->find($id);
        return parent::respuestaJson($provincia);
    }

    public function destroy($id)
    {
        $provincia = $this->repositorioDeProvincias->find($id);
        $provincia->setActivo(false);
        $this->repositorioDeProvincias->entityManager()->persist($provincia); //PEPARA LA SENTENCIA UPDATE
        $this->repositorioDeProvincias->entityManager()->flush(); //EJECUTA LA SENTENCIAS
    }
}
