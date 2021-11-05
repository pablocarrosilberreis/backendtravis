<?php

namespace App\Http\Controllers\API\Publicacion;

use App\Http\Controllers\Controller;
use App\Models\Entities\Publicaciones\Publicacion;
use App\Models\Entities\Publicaciones\PublicacionEstado;
use App\Models\Entities\Publicaciones\PublicacionModalidadContrato;
use App\Models\Repositories\RepositorioDeCategoriasDePublicaciones;
use App\Models\Repositories\RepositoriodeEmpresas;
use App\Models\Repositories\RepositorioDeEstados;
use App\Models\Repositories\RepositorioDeLocalidades;
use App\Models\Repositories\RepositorioDePublicaciones;
use App\Models\Repositories\RepositorioDePublicacionesPostulantes;
use App\Models\Repositories\RepositorioDePublicacionEstados;
use App\Models\Repositories\RepositorioDePublicacionModalidadesContratos;
use App\Models\Repositories\RepositorioDeUsuarios;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class PublicacionesController extends Controller
{
    private RepositorioDePublicaciones $repositorioDePublicaciones;
    private RepositorioDeCategoriasDePublicaciones $repositorioDeCategoriasDePublicaciones;
    private RepositorioDeLocalidades $repositorioDeLocalidades;
    private RepositoriodeEmpresas $repositoriodeEmpresas;
    private RepositorioDePublicacionEstados $repositorioDePublicacionEstados;
    private RepositorioDePublicacionesPostulantes $repositorioDePublicacionesPostulantes;
    private RepositorioDePublicacionModalidadesContratos $repositorioDePublicacionModalidadesContratos;
    private RepositorioDeEstados $repositorioDeEstados;
    private RepositorioDeUsuarios $repositorioDeUsuarios;

    public function __construct(RepositorioDePublicaciones                   $repositorioDePublicaciones,
                                RepositorioDeLocalidades                     $repositorioDeLocalidades,
                                RepositoriodeEmpresas                        $repositoriodeEmpresas,
                                RepositorioDePublicacionesPostulantes        $repositorioDePublicacionesPostulantes,
                                RepositorioDeCategoriasDePublicaciones $repositorioDeCategoriasDePublicaciones,
                                RepositorioDePublicacionEstados $repositorioDePublicacionEstados,
                                RepositorioDeEstados $repositorioDeEstados,
                                RepositorioDePublicacionModalidadesContratos $repositorioDePublicacionModalidadesContratos,
                                RepositorioDeUsuarios $repositorioDeUsuarios)
    {
        $this->repositorioDePublicaciones = $repositorioDePublicaciones;
        $this->repositorioDeLocalidades = $repositorioDeLocalidades;
        $this->repositoriodeEmpresas = $repositoriodeEmpresas;
        $this->repositorioDePublicacionEstados = $repositorioDePublicacionEstados;
        $this->repositorioDePublicacionesPostulantes = $repositorioDePublicacionesPostulantes;
        $this->repositorioDeCategoriasDePublicaciones = $repositorioDeCategoriasDePublicaciones;
        $this->repositorioDePublicacionModalidadesContratos = $repositorioDePublicacionModalidadesContratos;
        $this->repositorioDeEstados = $repositorioDeEstados;
        $this->repositorioDeUsuarios = $repositorioDeUsuarios;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\RecursoNoEncontradoException
     */
    public function index()
    {
        $publicaciones = $this->repositorioDePublicaciones->findBy([
            'activo' => true,
            'oculto' => false,
        ], [
            'fechaInicio' => 'ASC'
        ]);
        return parent::respuestaJson($publicaciones);
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
        //TODO: Validar campos
        $publicacion = new Publicacion();
        $this->asginarParametros($publicacion, $request);
        $this->repositorioDePublicaciones->entityManager()->persist($publicacion);
        $this->repositorioDePublicaciones->entityManager()->flush();
        return parent::respuestaJson($publicacion);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\RecursoNoEncontradoException
     */
    public function show($id)
    {
        $publicacion = $this->repositorioDePublicaciones->find($id);
        return parent::respuestaJson($publicacion);
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
        $publicacion = $this->repositorioDePublicaciones->find($id);
        $this->asginarParametros($publicacion, $request);
        $this->repositorioDePublicaciones->entityManager()->persist($publicacion);
        $this->repositorioDePublicaciones->entityManager()->flush();
        return parent::respuestaJson($publicacion);
    }

    public function destroy($id)
    {
        $publicacion = $this->repositorioDePublicaciones->find($id);
        $publicacion->desactivar();
        $this->repositorioDePublicaciones->entityManager()->persist($publicacion);
        $this->repositorioDePublicaciones->entityManager()->flush();
    }

    private function asginarParametros(Publicacion $publicacion, $parametros, $estaCreando = true)
    {
        $publicacion->activar();
        $publicacion->mostrar();
        $publicacion->setTitulo($parametros['titulo']);
        $publicacion->setDescripcion($parametros['descripcion']);
        $publicacion->setRequisitos($parametros['requisitos']);
        $publicacion->setSalario($parametros['salario']);
        $publicacion->setHorarioInicio($parametros['horario_inicio']);
        $publicacion->setHorarioFin($parametros['horario_fin']);
        $publicacion->setBeneficios($parametros['beneficios']);
        //TODO: Verificar fechas antes de setearlas en el validate
        $publicacion->setFechaInicio(\DateTime::createFromFormat('Y-m-d', $parametros["fecha_inicio"]));
        $publicacion->setFechaCierre(\DateTime::createFromFormat('Y-m-d', $parametros["fecha_cierre"]));
        $publicacion->setFechaUltimaModificacion(new \DateTime('now'));
        $publicacion->setLink($parametros['link']);
        $publicacion->setDireccionImagen($parametros['direccion_imagen']);
        $publicacion->setFechaVistoPorEmpresa(new \DateTime('now'));
        $publicacion->setVistoPorEmpresa(0);

        $this->asignarModalidadContrato($publicacion, $parametros);
        $this->asignarPublicacionEstado($publicacion, $parametros);
        $this->asignarCategoria($publicacion, $parametros);
        $this->asignarEmpresa($publicacion, $parametros);
        $this->asignarLocalidad($publicacion, $parametros);
    }

    private function asignarModalidadContrato(Publicacion $publicacion, $parametros)
    {
        $modalidadContrato = new PublicacionModalidadContrato();
        $modalidadContrato->setNombre($parametros['modalidad_contrato']['nombre']);
        $publicacion->setModalidadContrato($modalidadContrato);
    }

    private function asignarPublicacionEstado(Publicacion $publicacion, $parametros)
    {
        $publicacionEstado = new PublicacionEstado();
        $publicacionEstado->setEstado($this->repositorioDeEstados->find($parametros['publicacion_estado']['estado_id']));
        $publicacionEstado->setFecha(new \DateTime('now'));
        $publicacionEstado->setUsuario($this->repositorioDeUsuarios->find($parametros['publicacion_estado']['usuario_id']));
        $publicacionEstado->setPublicacion($publicacion);
        $publicacion->setPublicacionEstadoActual($publicacionEstado);
    }

    private function asignarCategoria(Publicacion $publicacion, $parametros)
    {
        $publicacionCategoria = $this->repositorioDeCategoriasDePublicaciones->find($parametros['publicacion_categoria_id']);
        $publicacion->setPublicacionCategoria($publicacionCategoria);
    }

    private function asignarEmpresa(Publicacion $publicacion, $parametros)
    {
        $empresa = $this->repositoriodeEmpresas->find($parametros['empresa_id']);
        $publicacion->setEmpresa($empresa);
    }

    private function asignarLocalidad(Publicacion $publicacion, $parametros)
    {
        $localidad = $this->repositorioDeLocalidades->find($parametros['localidad_id']);
        $publicacion->setLocalidad($localidad);
    }
}
