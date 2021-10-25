<?php

namespace App\Models\Entities\Publicaciones;

use App\Models\Entities\Persistente;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class PublicacionModalidadContrato
 * @package App\Models\Entities\Publicaciones
 * @ORM\Entity(repositoryClass="App\Models\Repositories\RepositorioDePublicacionModalidadesContratos")
 * @ORM\Table(name="modalidad_contrato")
 */
class PublicacionModalidadContrato extends Persistente implements \JsonSerializable
{
    /**
     * @var string
     * @ORM\Column(name="nombre", type="string")
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
            'id' => $this->getId(),
            'nombre' => $this->getNombre()
        ];
    }
}
