<?php


namespace App\Models\Entities\Idioma;


use App\Models\Entities\Persistente;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * Class Idioma
 * @package App\Models\Entities\Idioma
 * @ORM\Entity(repositoryClass="App\Models\Repositories\RepositorioDeIdioma")
 * @ORM\Table(name="idioma")
 */
class Idioma extends Persistente implements JsonSerializable
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
