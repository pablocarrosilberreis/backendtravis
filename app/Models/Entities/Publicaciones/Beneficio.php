<?php

namespace App\Models\Entities\Publicaciones;

use App\Models\Entities\Persistente;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Beneficio
 * @package App\Models\Entities\Publicaciones
 * @ORM\Entity
 * @ORM\Table(name="beneficio")
 */
class Beneficio extends Persistente
{
    /**
     * @var string
     */
    private string $beneficio;
    /**
     * @var Publicacion
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Publicaciones\Publicacion", fetch="EXTRA_LAZY", inversedBy="beneficios")
     */
    private $publicacion;

    /**
     * @return string
     */
    public function getBeneficio(): string
    {
        return $this->beneficio;
    }

    /**
     * @param string $beneficio
     */
    public function setBeneficio(string $beneficio): void
    {
        $this->beneficio = $beneficio;
    }

    /**
     * @param Publicacion $publicacion
     */
    public function setPublicacion(Publicacion $publicacion): void
    {
        $this->publicacion = $publicacion;
    }
}
