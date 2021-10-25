<?php

namespace App\Models\Entities\Postulados;

use App\Models\Entities\Persistente;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ExperienciaLaboral
 * @package App\Models\Entities\Postulados
 * @ORM\Entity(repositoryClass="App\Models\Repositories\RepositorioDeExperienciasLaborales")
 * @ORM\Table(name="experiencia_laboral")
 */
class ExperienciaLaboral extends Persistente implements \JsonSerializable
{
    /**
     * @var string
     * @ORM\Column(name="empresa", type="string")
     */
    private $empresa;

    /**
     * @var \DateTime
     * @ORM\Column(name="tiempoDesde", type="date")
     */
    private $tiempoDesde;

    /**
     * @var \DateTime
     * @ORM\Column(name="tiempoHasta", type="date")
     */
    private $tiempoHasta;

    /**
     * @var string
     * @ORM\Column(name="descripcion", type="string")
     */
    private $descripcion;

    /**
     * @var Postulante
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Postulados\Postulante", fetch="EXTRA_LAZY", inversedBy="experienciasLaborales")
     * @ORM\JoinColumn(name="postulante_id", referencedColumnName="id")
     */
    private Postulante $postulante;

    /**
     * @return string
     */
    public function getEmpresa(): string
    {
        return $this->empresa;
    }

    /**
     * @param string $empresa
     */
    public function setEmpresa(string $empresa): void
    {
        $this->empresa = $empresa;
    }

    /**
     * @return \DateTime
     */
    public function getTiempoDesde(): \DateTime
    {
        return $this->tiempoDesde;
    }

    /**
     * @param \DateTime $tiempoDesde
     */
    public function setTiempoDesde(\DateTime $tiempoDesde): void
    {
        $this->tiempoDesde = $tiempoDesde;
    }

    /**
     * @return \DateTime
     */
    public function getTiempoHasta(): \DateTime
    {
        return $this->tiempoHasta;
    }

    /**
     * @param \DateTime $tiempoHasta
     */
    public function setTiempoHasta(\DateTime $tiempoHasta): void
    {
        $this->tiempoHasta = $tiempoHasta;
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
     * @return Postulante
     */
    public function getPostulante(): Postulante
    {
        return $this->postulante;
    }

    /**
     * @param Postulante $postulante
     */
    public function setPostulante(Postulante $postulante): void
    {
        $this->postulante = $postulante;
    }

    public function jsonSerialize()
    {
        return [
            "id"            => $this->getId(),
            "tiempoDesde"   => $this->getTiempoDesde(),
            "tiempoHasta"   => $this->getTiempoHasta(),
            "descripcion"   => $this->getDescripcion(),
        ];
    }
}
