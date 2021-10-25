<?php


namespace App\Models\Entities\Postulados;

use App\Models\Entities\Persistente;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class TipoDeDocumento
 * @package App\Models\Entities\Postulado
 * @ORM\Entity(repositoryClass="App\Models\Repositories\RepositorioDeTipoDeDocumento")
 * @ORM\Table(name="tipo_documento")
 */
class TipoDeDocumento extends Persistente implements \JsonSerializable
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

    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "nombre" => $this->getNombre(),
        ];
    }
}
