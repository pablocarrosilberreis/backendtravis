<?php

namespace App\Models\Entities\Publicaciones;

use App\Models\Entities\Persistente;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Responsabilidad
 * @package App\Models\Entities\Publicaciones
 * @ORM\Entity
 * @ORM\Table(name="responsabilidad")
 */
class Responsabilidad extends Persistente
{
    /**
     * @var string
     * @ORM\Column(name="descripcion", type="string")
     */
    private string $responsabilidad;
    /**
     * @var Publicacion
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Publicaciones\Publicacion", fetch="EXTRA_LAZY", inversedBy="responsabilidades")
     */
    private $publicacion;

    /**
     * @return string
     */
    public function getResponsabilidad(): string
    {
        return $this->responsabilidad;
    }

    /**
     * @param string $responsabilidad
     */
    public function setResponsabilidad(string $responsabilidad): void
    {
        $this->responsabilidad = $responsabilidad;
    }

    /**
     * @param Publicacion $publicacion
     */
    public function setPublicacion(Publicacion $publicacion): void
    {
        $this->publicacion = $publicacion;
    }
}
