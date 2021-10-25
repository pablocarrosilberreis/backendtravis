<?php

namespace App\Http\Controllers\API\Ubicacion;

use App\Http\Controllers\Controller;
use App\Models\Repositories\RepositorioDeLocalidades;
use App\Models\Repositories\RepositorioDeMunicipios;
use App\Models\Repositories\RepositorioDeProvincias;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Parent_;

class MunicipiosController extends Controller
{
    private RepositorioDeMunicipios $repositorioDeMunicipios;
    private RepositorioDeProvincias $repositorioDeProvincias;

    /**
     * MunicipiosController constructor.
     * @param RepositorioDeMunicipios $repositorioDeMunicipios
     * @param RepositorioDeProvincias $repositorioDeProvincias
     */
    public function __construct(RepositorioDeMunicipios $repositorioDeMunicipios, RepositorioDeProvincias $repositorioDeProvincias)
    {
        $this->repositorioDeMunicipios = $repositorioDeMunicipios;
        $this->repositorioDeProvincias = $repositorioDeProvincias;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id)
    {
        $provincia = $this->repositorioDeProvincias->find($id);
        $municipios = $this->repositorioDeMunicipios->findBy([
            'provincia' => $provincia
        ]);

        return parent::respuestaJson($municipios);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $municipio = $this->repositorioDeMunicipios->find($id);

        return parent::respuestaJson($municipio);
    }
}
