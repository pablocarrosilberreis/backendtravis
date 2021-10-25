<?php

namespace App\Models\Entities\Postulados;

use App\Models\Entities\Persistente;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class TipoDeEstadoDelPostulante
 * @package App\Models\Entities\Postulados
 * @ORM\Entity(repositoryClass="App\Models\Repositories\RepositorioDeTiposEstadosDelPostulantes")
 * @ORM\Table(name="estado_postulante")
 */
class TipoDeEstadoDelPostulante extends Persistente implements \JsonSerializable
{
    private string $nombre;

    /**
     * @return string
     * @ORM\Column(name="nombre", type="string")
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
            "id"      => $this->getId(),
            "nombre"  => $this->getNombre(),
        ];
    }
}
