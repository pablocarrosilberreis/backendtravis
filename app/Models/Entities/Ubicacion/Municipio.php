<?php


namespace App\Models\Entities\Ubicacion;

use Doctrine\ORM\Mapping as ORM;
use App\Models\Entities\Persistente;

/**
 * Class Municipio
 * @package App\Models\Entities\Ubicacion
 * @ORM\Entity(repositoryClass="RepositorioDeMunicipios")
 * @ORM\Table(name="municipio")
 */
class Municipio extends Persistente implements \JsonSerializable
{
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $nombre;

    /**
     * @var Provincia
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Ubicacion\Provincia", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="provincia_id", referencedColumnName="id")
     */
    private $provincia;

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'provincia' => $this->getProvincia(),
        ];
    }
}
