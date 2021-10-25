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
}
