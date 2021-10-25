<?php

namespace App\Models\Entities\Publicaciones;

use App\Models\Entities\Activable;
use App\Models\Entities\Persistente;
use App\Models\Entities\Postulados\Postulante;
use Illuminate\Support\Facades\Date;
use phpDocumentor\Reflection\Types\Integer;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class PublicacionPostulante
 * @package App\Models\Entities\Publicaciones
 * @ORM\Entity(repositoryClass="App\Models\Repositories\RepositorioDePublicacionesPostulantes")
 * @ORM\Table(name="publicacion_Postulante")
 */
class PublicacionPostulante extends Activable implements \JsonSerializable
{
    /**
     * @var Publicacion
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Publicaciones\Publicacion", fetch="EXTRA_LAZY", inversedBy="publicacionesPostulantes")
     * @ORM\JoinColumn(name="publicacion_id", referencedColumnName="id")
     */
    private Publicacion $publicacion;

    /**
     * @var Postulante
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Postulados\Postulante", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="postulante_id", referencedColumnName="id")
     */
    private Postulante $postulante;

    /**
     * @var string
     * @ORM\Column(name="remuneracionPretendida", type="string")
     */
    private string $remuneracionPretendida;

    /**
     * @var Date
     * @ORM\Column(name="fecha", type="date")
     */
    private Date $fecha;

    /**
     * @var int
     * @ORM\Column(name="aceptado", type="integer")
     */
    private Integer $aceptado;

    /**
     * @return Publicacion
     */
    public function getPublicacion(): Publicacion
    {
        return $this->publicacion;
    }

    /**
     * @param Publicacion $publicacion
     */
    public function setPublicacion(Publicacion $publicacion): void
    {
        $this->publicacion = $publicacion;
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
     * @return string
     */
    public function getRemuneracionPretendida(): string
    {
        return $this->remuneracionPretendida;
    }

    /**
     * @param string $remuneracionPretendida
     */
    public function setRemuneracionPretendida(string $remuneracionPretendida): void
    {
        $this->remuneracionPretendida = $remuneracionPretendida;
    }

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
     * @return int
     */
    public function getAceptado(): int
    {
        return $this->aceptado;
    }

    /**
     * @param int $aceptado
     */
    public function setAceptado(int $aceptado): void
    {
        $this->aceptado = $aceptado;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'activo' => $this->isActivo(),
            'publicacion_id' => $this->getPublicacion()->getId(),
            'postulante_id' => $this->getPostulante()->getId(),
            'remuneracion_pretendida' => $this->getRemuneracionPretendida(),
            'fecha' => $this->getFecha(),
            'aceptado' => $this->getAceptado()
        ];
    }
}
