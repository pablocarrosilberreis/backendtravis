<?php

namespace App\Models\Entities\Publicaciones;

use App\Models\Entities\Activable;
use App\Models\Entities\Persistente;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Empresa
 * @package App\Models\Entities\Publicaciones
 * @ORM\Entity(repositoryClass="App\Models\Repositories\RepositoriodeEmpresas")
 * @ORM\Table(name="empresa")
 */
class Empresa extends Activable implements \JsonSerializable
{
    /**
     * @var string
     * @ORM\Column(name="nombre", type="string")
     */
    private string $nombre;

    /**
     * @var string
     * @ORM\Column(name="descripcion", type="string")
     */
    private string $descripcion;

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
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

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'activo' => $this->isActivo(),
            'nombre' => $this->getNombre(),
            'descripcion' => $this->getDescripcion()
        ];
    }
}
