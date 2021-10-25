<?php

namespace App\Models\Entities\Postulados;

use App\Models\Entities\Activable;
use App\Models\Entities\Persistente;
use Illuminate\Support\Facades\Date;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class PostulanteCV
 * @package App\Models\Entities\Postulado
 * @ORM\Entity(repositoryClass="App\Models\Repositories\RepositorioDePostulanteCVs")
 * @ORM\Table(name="postulante_cv")
 */
class PostulanteCV extends Activable implements \JsonSerializable
{
    /**
     * @var string
     * @ORM\Column(name="ruta", type="string")
     */
    private string $ruta;

    /**
     * @var Date
     * @ORM\Column(name="fecha", type="date")
     */
    private Date $fecha;

    /**
     * @var Postulante
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Postulados\Postulante", fetch="EXTRA_LAZY", inversedBy="postulanteCVs")
     * @ORM\JoinColumn(name="postulante_id", referencedColumnName="id")
     */
    private Postulante $postulante;

    /**
     * @return string
     */
    public function getRuta(): string
    {
        return $this->ruta;
    }

    /**
     * @param string $ruta
     */
    public function setRuta(string $ruta): void
    {
        $this->ruta = $ruta;
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
            'id' => $this->getId(),
            'activo' => $this->isActivo(),
            'ruta' => $this->getRuta(),
            'fecha' => $this->getFecha(),
            'postulante_id' => $this->getPostulante()->getId()
        ];
    }
}
