<?php

namespace App\Http\Controllers\API\Postulado;

use App\Http\Controllers\Controller;
use App\Models\Entities\Idioma\PostulanteIdioma;
use App\Models\Entities\Postulados\Postulante;
use App\Models\Entities\Postulados\Telefono;
use App\Models\Entities\Ubicacion\Direccion;
use App\Models\Repositories\RepositorioDeCategoriasDePublicaciones;
use App\Models\Repositories\RepositorioDeIdioma;
use App\Models\Repositories\RepositorioDeLocalidades;
use App\Models\Repositories\RepositorioDePaises;
use App\Models\Repositories\RepositorioDePostulantes;
use App\Models\Repositories\RepositorioDeTipoDeDocumento;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use phpDocumentor\Reflection\Types\Array_;

class PostulantesController extends Controller
{
    private RepositorioDePostulantes $repositorioDePostulantes;
    private RepositorioDeLocalidades $repositorioDeLocalidades;
    private RepositorioDeCategoriasDePublicaciones $repositorioDeCategoriasDePublicaciones;
    private RepositorioDeTipoDeDocumento $repositorioDeTipoDeDocumento;
    private RepositorioDePaises $repositorioDePaises;
    private RepositorioDeIdioma $repositorioDeIdioma;

    /**
     * PostulantesController constructor.
     * @param RepositorioDePostulantes $repositorioDePostulantes
     * @param RepositorioDeLocalidades $repositorioDeLocalidades
     * @param RepositorioDeCategoriasDePublicaciones $repositorioDeCategoriasDePublicaciones
     */
    public function __construct(RepositorioDePostulantes $repositorioDePostulantes,
                                RepositorioDeLocalidades $repositorioDeLocalidades,
                                RepositorioDeCategoriasDePublicaciones $repositorioDeCategoriasDePublicaciones,
                                RepositorioDeTipoDeDocumento $repositorioDeTipoDeDocumento,
                                RepositorioDePaises $repositorioDePaises,
                                RepositorioDeIdioma $repositorioDeIdioma)
    {
        $this->repositorioDePostulantes = $repositorioDePostulantes;
        $this->repositorioDeLocalidades = $repositorioDeLocalidades;
        $this->repositorioDeCategoriasDePublicaciones = $repositorioDeCategoriasDePublicaciones;
        $this->repositorioDeTipoDeDocumento = $repositorioDeTipoDeDocumento;
        $this->repositorioDePaises = $repositorioDePaises;
        $this->repositorioDeIdioma = $repositorioDeIdioma;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\RecursoNoEncontradoException
     */
    public function index()
    {
        $postulantes = $this->repositorioDePostulantes->findAll();
        return parent::respuestaJson($postulantes);
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
        $postulante = new Postulante();
        $this->asignarParametros($postulante, $request);
        $this->repositorioDePostulantes->entityManager()->persist($postulante);
        $this->repositorioDePostulantes->entityManager()->flush();
        return parent::respuestaJson($postulante);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\RecursoNoEncontradoException
     */
    public function show($id)
    {
        $postulante = $this->repositorioDePostulantes->find($id);
        return parent::respuestaJson($postulante);
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
        $postulante = $this->repositorioDePostulantes->find($id);
        $this->asignarParametros($postulante, $request);
        $this->repositorioDePostulantes->entityManager()->persist($postulante);
        $this->repositorioDePostulantes->entityManager()->flush();
        return parent::respuestaJson($postulante);
    }

    public function destroy($id)
    {
        $postulante = $this->repositorioDePostulantes->find($id);
        $postulante->desactivar();
        $this->repositorioDePostulantes->entityManager()->persist($postulante);
        $this->repositorioDePostulantes->entityManager()->flush();
    }

    private function asignarParametros(Postulante $postulante, $parametros, $estaCreando = true)
    {
        $postulante->setNombre($parametros['nombre']);
        $postulante->setApellido($parametros['apellido']);
        $postulante->setEmail($parametros['email']);
        $postulante->setFechaDeNacimiento(\DateTime::createFromFormat("Y-m-d", $parametros['fecha_nacimiento']));
        $postulante->activar();

        $this->asignarDireccion($postulante, $parametros);
        $postulante->setDisponibilidadParaViajar($parametros['disponibilidad_viaje']);
        $this->asignarTipoDocumento($postulante, $parametros);
        $postulante->setNroDocumento($parametros['nro_documento']);


        $this->asignarNacionalidades($postulante, $parametros);
        $this->asignarIntereses($postulante, $parametros);


        $this->asignarTelefonos($postulante, $parametros);
        $this->asignarNivelesDeIdioma($postulante, $parametros);
    }

    private function asignarDireccion(Postulante $postulante, $parametros)
    {
        $direccion = new Direccion();
        $direccion->setAltura($parametros["direccion"]["altura"]);
        $direccion->setCalle($parametros["direccion"]["calle"]);
        $direccion->setPiso($parametros["direccion"]["piso"]);
        $direccion->setDepto($parametros["direccion"]["depto"]);
        $localidad = $this->repositorioDeLocalidades->find($parametros["direccion"]["localidad_id"]);
        $direccion->setLocalidad($localidad);
        $postulante->setDireccion($direccion);
    }

    private function asignarIntereses(Postulante $postulante, $parametros)
    {
        $idCategorias = $parametros['intereses'];
        foreach ($idCategorias as $idCategoria) {
            $categoria = $this->repositorioDeCategoriasDePublicaciones->find($idCategoria);
            if (is_null($categoria)) continue;
            $postulante->agregarCategoria($categoria);
        }
    }

    private function asignarTelefonos(Postulante $postulante, $parametros)
    {
        $telefonos = $parametros['telefonos'];
        foreach ($telefonos as $telefono) {
            $unTelefono = new Telefono();
            $unTelefono->setTelefono($telefono['numero']);
            $unTelefono->setCodArea($telefono['cod_area']);
            $postulante->agregarTelefono($unTelefono);
        }
    }

    private function asignarTipoDocumento(Postulante $postulante, $parametros)
    {
        $tipoDocumento = $this->repositorioDeTipoDeDocumento->find($parametros['tipo_documento_id']);
        $postulante->setTipoDocumento($tipoDocumento);
    }

    private function asignarNacionalidades(Postulante $postulante, $parametros)
    {
        $nacionalidades = $parametros['nacionalidades'];
        foreach ($nacionalidades as $nacionalidad_id) {
            $nacionalidad = $this->repositorioDePaises->find($nacionalidad_id);
            $postulante->agregarNacionalidades($nacionalidad);
        }
    }

    private function asignarNivelesDeIdioma(Postulante $postulante, $parametros)
    {
        $nivelesDeIdioma = $parametros['niveles_idioma'];
        foreach ($nivelesDeIdioma as $nivelDeIdioma) {
            $unNivelDeIdioma = new PostulanteIdioma();
            $unIdioma = $this->repositorioDeIdioma->find($nivelDeIdioma['idioma_id']);
            $unNivelDeIdioma->setIdioma($unIdioma);
            $unNivelDeIdioma->setNivelOral($nivelDeIdioma['nivel_oral']);
            $unNivelDeIdioma->setNivelEscrito($nivelDeIdioma['nivel_escrito']);
            $postulante->agregarNivelDeIdioma($unNivelDeIdioma);
        }
    }
}
