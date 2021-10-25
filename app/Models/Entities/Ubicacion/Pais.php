<?php


namespace App\Models\Entities\Ubicacion;

use App\Models\Entities\Persistente;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Pais
 * @package App\Models\Entities\Ubicacion
 * @ORM\Entity(repositoryClass="App\Models\Repositories\RepositorioDePaises")
 * @ORM\Table(name="pais")
 */
class Pais extends Persistente implements \JsonSerializable
{
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $nombre;

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

    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "nombre" => $this->getNombre(),
        ];
    }
}
