<?php

namespace App\Http\Controllers\API\Ubicacion;

use App\Http\Controllers\Controller;
use App\Models\Repositories\RepositorioDeLocalidades;
use App\Models\Repositories\RepositorioDeMunicipios;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Parent_;

class LocalidadesController extends Controller
{
    private RepositorioDeLocalidades $repositorioDeLocalidades;
    private RepositorioDeMunicipios $repositorioDeMunicipios;

    /**
     * LocalidadesController constructor.
     * @param RepositorioDeLocalidades $repositorioDeLocalidades
     * @param RepositorioDeMunicipios $repositorioDeMunicipios
     */
    public function __construct(RepositorioDeLocalidades $repositorioDeLocalidades, RepositorioDeMunicipios $repositorioDeMunicipios)
    {
        $this->repositorioDeLocalidades = $repositorioDeLocalidades;
        $this->repositorioDeMunicipios = $repositorioDeMunicipios;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        $municipio = $this->repositorioDeMunicipios->find($id);
        $localidades = $this->repositorioDeLocalidades->findBy([
            'municipio' => $municipio
        ]);

        return parent::respuestaJson($localidades);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $localidad = $this->repositorioDeLocalidades->find($id);

        return parent::respuestaJson($localidad);
    }
}
