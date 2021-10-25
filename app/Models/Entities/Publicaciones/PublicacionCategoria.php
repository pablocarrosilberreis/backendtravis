<?php


namespace App\Models\Entities\Publicaciones;


use App\Models\Entities\Activable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class PublicacionCategoria
 * @package App\Models\Entities\Publicaciones
 * @ORM\Entity(repositoryClass="App\Models\Repositories\RepositorioDeCategoriasDePublicaciones")
 * @ORM\Table(name="publicacion_categoria")
 */
class PublicacionCategoria extends Activable implements \JsonSerializable
{
    /**
     * @var string
     * @ORM\Column(name="nombre", type="string")
     */
    private $nombre;

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
            "id"        => $this->getId(),
            "nombre"    => $this->nombre,
            "activo"    => $this->isActivo(),
        ];
    }
}
