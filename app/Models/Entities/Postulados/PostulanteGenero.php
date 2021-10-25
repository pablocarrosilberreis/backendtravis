<?php

namespace App\Models\Entities\Postulados;

use App\Models\Entities\Persistente;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class PostulanteGenero
 * @package App\Models\Entities\Postulado
 * @ORM\Entity
 * @ORM\Table(name="genero")
 */
class PostulanteGenero extends Persistente implements \JsonSerializable
{
    /**
     * @var string
     * @ORM\Column(name="nombre", type="string")
     */
    private string $nombre;

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }


    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre()
        ];
    }
}
