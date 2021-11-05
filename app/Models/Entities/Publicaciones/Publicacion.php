<?php

namespace App\Models\Entities\Publicaciones;

use App\Models\Entities\Activable;
use App\Models\Entities\Persistente;
use App\Models\Entities\Ubicacion\Direccion;
use App\Models\Entities\Ubicacion\Localidad;
use Cassandra\Tinyint;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;
use Illuminate\Support\Facades\Date;
use Ramsey\Uuid\Type\Integer;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Publicacion
 * @package App\Models\Entities\Publicaciones
 * @ORM\Entity(repositoryClass="App\Models\Repositories\RepositorioDePublicaciones")
 * @ORM\Table(name="publicacion")
 */
class Publicacion extends Activable implements \JsonSerializable
{
    /**
     * @var string
     * @ORM\Column(name="titulo", type="string")
     */
    private string $titulo;

    /**
     * @var string
     * @ORM\Column(name="descripcion", type="string")
     */
    private string $descripcion;

    /**
     * @var string
     * @ORM\Column(name="salario", type="string")
     */
    private string $salario;

    /**
     * @var string
     * @ORM\Column(name="horarioInicio", type="string")
     */
    private string $horarioInicio;

    /**
     * @var string
     * @ORM\Column(name="horarioFin", type="string")
     */
    private string $horarioFin;


    /**
     * @var \DateTime
     * @ORM\Column(name="fechaInicio", type="date")
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     * @ORM\Column(name="fechaCierre", type="date")
     */
    private $fechaCierre;

    /**
     * @var \DateTime
     * @ORM\Column(name="fechaUltimaModificacion", type="date")
     */
    private $fechaUltimaModificacion;

    /**
     * @var string
     * @ORM\Column(name="link", type="string")
     */
    private string $link;

    /**
     * @var string
     * @ORM\Column(name="direccionImagen", type="string")
     */
    private string $direccionImagen;

    /**
     * @var int
     * @ORM\Column(name="vistoPorEmpresa", type="integer")
     */
    private $vistoPorEmpresa;

    /**
     * @var \DateTime
     * @ORM\Column(name="fechaVistoPorEmpresa", type="date")
     */
    private $fechaVistoPorEmpresa;

    /**
     * @var Requisito[]|ArrayCollection|PersistentCollection
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Publicaciones\Requisito", fetch="EXTRA_LAZY", cascade={"ALL"}, mappedBy="publicacion")
     */
    private $requisitos;

    /**
     * @var Beneficio[]|ArrayCollection|PersistentCollection
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Publicaciones\Beneficio", fetch="EXTRA_LAZY", cascade={"ALL"}, mappedBy="publicacion")
     */
    private $beneficios;

    /**
     * @var Responsabilidad[]|ArrayCollection|PersistentCollection
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Publicaciones\Responsabilidad", fetch="EXTRA_LAZY", cascade={"ALL"}, mappedBy="publicacion")
     */
    private $responsabilidades;

    /**
     * @var PublicacionCategoria
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Publicaciones\PublicacionCategoria", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="publicacionCategoria_id", referencedColumnName="id")
     */
    private $publicacionCategoria;

    /**
     * @var Localidad
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Ubicacion\Localidad", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="localidad_id", referencedColumnName="id")
     */
    private Localidad $localidad;

    /**
     * @var Empresa
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Publicaciones\Empresa", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
     */
    private Empresa $empresa;

    /**
     * @var PublicacionModalidadContrato
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Publicaciones\PublicacionModalidadContrato", fetch="EXTRA_LAZY", cascade={"ALL"})
     * @ORM\JoinColumn(name="modalidadContrato_id")
     */
    private PublicacionModalidadContrato $modalidadContrato;

    /**
     * @var PublicacionEstado[]|ArrayCollection|PersistentCollection
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Publicaciones\PublicacionEstado", fetch="EXTRA_LAZY", mappedBy="publicacion", cascade={"ALL"})
     */
    private $publicacionEstados;

    /**
     * @var PublicacionEstado
     * @ORM\OneToOne(targetEntity="App\Models\Entities\Publicaciones\PublicacionEstado", fetch="EXTRA_LAZY", cascade={"ALL"})
     * @ORM\JoinColumn(name="publicacionEstadoActual_id", referencedColumnName="id")
     */
    private $publicacionEstadoActual;

    /**
     * @var PublicacionPostulante[]|ArrayCollection|PersistentCollection
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Publicaciones\PublicacionPostulante", fetch="EXTRA_LAZY", mappedBy="publicacion", cascade={"ALL"})
     */
    private $publicacionesPostulantes;

    public function __construct()
    {
        $this->requisitos = new ArrayCollection();
        $this->beneficios = new ArrayCollection();
        $this->responsabilidades = new ArrayCollection();
        $this->publicacionEstados = new ArrayCollection();
        $this->publicacionesPostulantes = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getTitulo(): string
    {
        return $this->titulo;
    }

    /**
     * @param string $titulo
     */
    public function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }

    /**
     * @return string
     */
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return string
     */
    public function getSalario(): string
    {
        return $this->salario;
    }

    /**
     * @param string $salario
     */
    public function setSalario(string $salario): void
    {
        $this->salario = $salario;
    }

    /**
     * @return string
     */
    public function getHorarioInicio(): string
    {
        return $this->horarioInicio;
    }

    /**
     * @param string $horarioInicio
     */
    public function setHorarioInicio(string $horarioInicio): void
    {
        $this->horarioInicio = $horarioInicio;
    }

    /**
     * @return string
     */
    public function getHorarioFin(): string
    {
        return $this->horarioFin;
    }

    /**
     * @param string $horarioFin
     */
    public function setHorarioFin(string $horarioFin): void
    {
        $this->horarioFin = $horarioFin;
    }

    /**
     * @return \DateTime
     */
    public function getFechaInicio(): \DateTime
    {
        return $this->fechaInicio;
    }

    /**
     * @param \DateTime $fechaInicio
     */
    public function setFechaInicio(\DateTime $fechaInicio): void
    {
        $this->fechaInicio = $fechaInicio;
    }

    /**
     * @return \DateTime
     */
    public function getFechaCierre(): \DateTime
    {
        return $this->fechaCierre;
    }

    /**
     * @param \DateTime $fechaCierre
     */
    public function setFechaCierre(\DateTime $fechaCierre): void
    {
        $this->fechaCierre = $fechaCierre;
    }

    /**
     * @return \DateTime
     */
    public function getFechaUltimaModificacion(): \DateTime
    {
        return $this->fechaUltimaModificacion;
    }

    /**
     * @param \DateTime $fechaUltimaModificacion
     */
    public function setFechaUltimaModificacion(\DateTime $fechaUltimaModificacion): void
    {
        $this->fechaUltimaModificacion = $fechaUltimaModificacion;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getDireccionImagen(): string
    {
        return $this->direccionImagen;
    }

    /**
     * @param string $direccionImagen
     */
    public function setDireccionImagen(string $direccionImagen): void
    {
        $this->direccionImagen = $direccionImagen;
    }

    /**
     * @return int
     */
    public function getVistoPorEmpresa(): int
    {
        return $this->vistoPorEmpresa;
    }

    /**
     * @param int $vistoPorEmpresa
     */
    public function setVistoPorEmpresa(int $vistoPorEmpresa): void
    {
        $this->vistoPorEmpresa = $vistoPorEmpresa;
    }

    /**
     * @return \DateTime
     */
    public function getFechaVistoPorEmpresa(): \DateTime
    {
        return $this->fechaVistoPorEmpresa;
    }

    /**
     * @param \DateTime $fechaVistoPorEmpresa
     */
    public function setFechaVistoPorEmpresa(\DateTime $fechaVistoPorEmpresa): void
    {
        $this->fechaVistoPorEmpresa = $fechaVistoPorEmpresa;
    }

    /**
     * @return PublicacionCategoria
     */
    public function getPublicacionCategoria(): PublicacionCategoria
    {
        return $this->publicacionCategoria;
    }

    /**
     * @param PublicacionCategoria $publicacionCategoria
     */
    public function setPublicacionCategoria(PublicacionCategoria $publicacionCategoria): void
    {
        $this->publicacionCategoria = $publicacionCategoria;
    }

    /**
     * @return Localidad
     */
    public function getLocalidad(): Localidad
    {
        return $this->localidad;
    }

    /**
     * @param Localidad $localidad
     */
    public function setLocalidad(Localidad $localidad): void
    {
        $this->localidad = $localidad;
    }

    /**
     * @return Empresa
     */
    public function getEmpresa(): Empresa
    {
        return $this->empresa;
    }

    /**
     * @param Empresa $empresa
     */
    public function setEmpresa(Empresa $empresa): void
    {
        $this->empresa = $empresa;
    }

    /**
     * @return PublicacionModalidadContrato
     */
    public function getModalidadContrato(): PublicacionModalidadContrato
    {
        return $this->modalidadContrato;
    }

    /**
     * @param PublicacionModalidadContrato $modalidadContrato
     */
    public function setModalidadContrato(PublicacionModalidadContrato $modalidadContrato): void
    {
        $this->modalidadContrato = $modalidadContrato;
    }

    /**
     * @return PublicacionEstado[]|ArrayCollection|PersistentCollection
     */
    public function getPublicacionEstados()
    {
        return $this->publicacionEstados;
    }

    /**
     * @param PublicacionEstado[]|ArrayCollection|PersistentCollection $publicacionEstadoActual
     */
    public function agregarEstado($publicacionEstado): void
    {
        if(!$this->publicacionEstados->contains($publicacionEstado))
        {
            $this->publicacionEstados->add($publicacionEstado);
        }
    }

    /**
     * @return PublicacionPostulante[]|ArrayCollection|PersistentCollection
     */
    public function getPublicacionesPostulantes()
    {
        return $this->publicacionesPostulantes;
    }

    /**
     * @param PublicacionPostulante
     */
    public function agregarPublicacionPostulante($publicacionPostulante): void
    {
        if(!$this->getPublicacionesPostulantes()->contains($publicacionPostulante))
        {
            $this->getPublicacionesPostulantes()->add($publicacionPostulante);
        }
    }

    /**
     * @return PublicacionEstado
     */
    public function getPublicacionEstadoActual(): PublicacionEstado
    {
        return $this->publicacionEstadoActual;
    }

    /**
     * @param PublicacionEstado $publicacionEstadoActual
     */
    public function setPublicacionEstadoActual(PublicacionEstado $publicacionEstadoActual): void
    {
        $this->publicacionEstadoActual = $publicacionEstadoActual;
        $this->agregarEstado($publicacionEstadoActual);
    }

    /**
     * @return Requisito[]
     */
    public function getRequisitos()
    {
        return $this->requisitos;
    }

    /**
     * @param Requisito
     */
    public function agregarRequisito(Requisito $requisito): void
    {
        $this->requisitos->add($requisito);
        $requisito->setPublicacion($this);
    }

    /**
     * @return Beneficio[]
     */
    public function getBeneficios()
    {
        return $this->beneficios;
    }

    /**
     * @param Beneficio
     */
    public function agregarBeneficio(Beneficio $beneficio): void
    {
        $this->beneficios->add($beneficio);
        $beneficio->setPublicacion($this);
    }

    /**
     * @return Responsabilidad[]
     */
    public function getResponsabilidades()
    {
        return $this->responsabilidades;
    }

    /**
     * @param Responsabilidad
     */
    public function agregarResponsabilidad(Responsabilidad $responsabilidad): void
    {
        $this->responsabilidades->add($responsabilidad);
        $responsabilidad->setPublicacion($this);
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'categoria_id' => $this->getPublicacionCategoria()->getId(),
            'titulo' => $this->getTitulo(),
            'descripcion' => $this->getDescripcion(),
            'requisitos' => $this->getRequisitos(),
            'beneficios' => $this->getBeneficios(),
            'responsabilidades' => $this->getResponsabilidades(),
            'localidad' => $this->getLocalidad(),
            'salario' => $this->getSalario(),
            'horarioInicio' => $this->getHorarioInicio(),
            'horarioFin' => $this->getHorarioFin(),
            'empresa_id' => $this->getEmpresa()->getId(),
            'modalidadContrato_id' => $this->getModalidadContrato()->getId(),
            'fechaInicio' => $this->getFechaInicio()->format('Y-m-d'),
            'fechaCierre' => $this->getFechaCierre()->format('Y-m-d'),
            'fechaUltModificacion' => $this->getFechaUltimaModificacion()->format('Y-m-d H:i'),
            'link' => $this->getLink(),
            'direccionImagen' => $this->getDireccionImagen(),
            'vistoPorEmpresa' => $this->getVistoPorEmpresa(),
            'fechaVistoPorEmpresa' => $this->getFechaVistoPorEmpresa(),
            'estadoActual' => $this->getPublicacionEstadoActual()->getEstado()
        ];
    }
}
