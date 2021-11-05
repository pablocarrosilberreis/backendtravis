<?php

namespace App\Models\Entities\Publicaciones;

use App\Models\Entities\Persistente;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Requisito
 * @package App\Models\Entities\Publicaciones
 * @ORM\Entity
 * @ORM\Table(name="requisito")
 */
class Requisito extends Persistente
{
    /**
     * @var string
     */
    private string $requisito;
    /**
     * @var Publicacion
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Publicaciones\Publicacion", inversedBy="requisitos", fetch="EXTRA_LAZY")
     */
    private $publicacion;

    /**
     * @return string
     */
    public function getRequisito(): string
    {
        return $this->requisito;
    }

    /**
     * @param string $requisito
     */
    public function setRequisito(string $requisito): void
    {
        $this->requisito = $requisito;
    }

    /**
     * @param Publicacion $publicacion
     */
    public function setPublicacion(Publicacion $publicacion): void
    {
        $this->publicacion = $publicacion;
    }
}
