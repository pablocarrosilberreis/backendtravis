<?php


namespace App\Models\Entities;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class Activable
 * @package App\Models\Entities
 * @ORM\MappedSuperclass
 */
abstract class Activable extends Persistente
{
    /**
     * @var boolean
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo = true;

    /**
     * @var bool
     * @ORM\Column(name="oculto", type="boolean")
     */
    private $oculto = false;

    /**
     * @return bool
     */
    public function isActivo(): bool
    {
        return $this->activo;
    }

    public function activar()
    {
        $this->activo = true;
    }

    public function desactivar()
    {
        $this->activo = false;
    }

    public function isOculto(): bool
    {
        return $this->oculto;
    }

    public function mostrar()
    {
        $this->oculto = false;
    }

    public function ocultar()
    {
        $this->oculto = true;
    }
}
