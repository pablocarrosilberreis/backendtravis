<?php


namespace App\Models\Entities\Ubicacion;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Provincia
 * @package App\Models\Entities\Ubicacion
 * @ORM\Entity(repositoryClass="App\Models\Repositories\RepositorioDeProvincias")
 * @ORM\Table(name="provincia")
 */
use App\Models\Entities\Persistente;

class Provincia extends Persistente implements \JsonSerializable
{
    /**
     * @var string
     * @ORM\Column(type="string", name="nombre")
     */
    private $nombre;

    /**
     * @var Pais
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Ubicacion\Pais", fetch="EXTRA_LAZY", cascade={"ALL"})
     * @ORM\JoinColumn(name="pais_id", referencedColumnName="id")
     */
    private Pais $pais;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private bool $activo;

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @return Pais
     */
    public function getPais(): Pais
    {
        return $this->pais;
    }

    /**
     * @return bool
     */
    public function isActivo(): bool
    {
        return $this->activo;
    }

    /**
     * @param bool $activo
     */
    public function setActivo(bool $activo): void
    {
        $this->activo = $activo;
    }

    public function jsonSerialize()
    {
        return [
            'id'      => $this->getId(),
            'nombre'  => $this->getNombre(),
            'pais_id' => $this->getPais(),
        ];
    }
}

