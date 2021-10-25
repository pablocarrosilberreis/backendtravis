<?php


namespace App\Models\Entities\Ubicacion;

use Doctrine\ORM\Mapping as ORM;
use App\Models\Entities\Persistente;

/**
 * Class Localidad
 * @package App\Models\Entities\Ubicacion
 * @ORM\Entity(repositoryClass="App\Models\Repositories\RepositorioDeLocalidades")
 * @ORM\Table(name="Localidad")
 */
class Localidad extends Persistente implements \JsonSerializable
{
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $nombre;
    /**
     * @var Municipio
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Ubicacion\Municipio", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="municipio_id", referencedColumnName="id")
     */
    private Municipio $municipio;
    /**
     * @var string
     * @ORM\Column(name="codPostal", nullable=true)
     */
    private $codPostal;

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @return Municipio
     */
    public function getMunicipio(): Municipio
    {
        return $this->municipio;
    }

    /**
     * @return string
     */
    public function getCodPostal(): string
    {
        return $this->codPostal;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'municipio' => $this->getMunicipio(),
            'cod_postal' => $this->codPostal,
        ];
    }
}
