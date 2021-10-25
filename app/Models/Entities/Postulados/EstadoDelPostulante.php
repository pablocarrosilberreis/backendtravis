<?php

namespace App\Models\Entities\Postulados;

use App\Models\Entities\Persistente;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Support\Facades\Date;

/**
 * Class EstadoDelPostulante
 * @package App\Models\Entities\Postulados
 * @ORM\Entity(repositoryClass="App\Models\Repositories\RepositorioDeEstadosDelPostulantes")
 * @ORM\Table(name="postulante_Estado")
 */
class EstadoDelPostulante extends Persistente implements \JsonSerializable
{
    /**
     * @var Date
     * @ORM\Column(name="fecha", type="date")
     */
    private Date $fecha;

    /**
     * @var Postulante
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Postulados\Postulante", fetch="EXTRA_LAZY", inversedBy="estadoPostulante")
     */
    private Postulante $postulante;

    /**
     * @var Usuario
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Postulados\Usuario", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     */
    private Usuario $usuario;

    /**
     * @var TipoDeEstadoDelPostulante
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Postulados\TipoDeEstadoDelPostulante", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="estadoPostulante_id", referencedColumnName="id")
     */
    private TipoDeEstadoDelPostulante $tipoDeEstadoDelPostulante;

    /**
     * @return Date
     */
    public function getFecha(): Date
    {
        return $this->fecha;
    }

    /**
     * @param Date $fecha
     */
    public function setFecha(Date $fecha): void
    {
        $this->fecha = $fecha;
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

    /**
     * @return Usuario
     */
    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }

    /**
     * @param Usuario $usuario
     */
    public function setUsuario(Usuario $usuario): void
    {
        $this->usuario = $usuario;
    }

    /**
     * @return TipoDeEstadoDelPostulante
     */
    public function getTipoDeEstadoDelPostulante(): TipoDeEstadoDelPostulante
    {
        return $this->tipoDeEstadoDelPostulante;
    }

    /**
     * @param TipoDeEstadoDelPostulante $tipoDeEstadoDelPostulante
     */
    public function setTipoDeEstadoDelPostulante(TipoDeEstadoDelPostulante $tipoDeEstadoDelPostulante): void
    {
        $this->tipoDeEstadoDelPostulante = $tipoDeEstadoDelPostulante;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'postulante_id' => $this->getPostulante()->getId(),
            'estadoPostulante_id' => $this->getTipoDeEstadoDelPostulante()->getId(),
            'fecha' => $this->getFecha(),
            'usuario_id' => $this->getUsuario()->getId()
        ];
    }
}
