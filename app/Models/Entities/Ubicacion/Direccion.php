<?php


namespace App\Models\Entities\Ubicacion;

use App\Http\Controllers\API\Postulado\PostulantesController;
use App\Models\Entities\Persistente;
use App\Models\Entities\Postulados\Postulante;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Direccion
 * @ORM\Entity
 * @ORM\Table(name="direccion")
 * @package App\Models\Entities\Ubicacion
 */
class Direccion extends Persistente implements \JsonSerializable
{
    /**
     * @var string
     * @ORM\Column(name="calle", type="string")
     */
    private $calle;
    /**
     * @var integer
     * @ORM\Column(name="altura", type="integer")
     */
    private $altura;
    /**
     * @var string|null
     * @ORM\Column(name="piso", type="string", nullable=true)
     */
    private $piso;
    /**
     * @var string|null
     * @ORM\Column(name="depto", type="string", nullable=true)
     */
    private $depto;
    /**
     * @var Localidad
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Ubicacion\Localidad", fetch="EXTRA_LAZY", cascade={"ALL"})
     * @ORM\JoinColumn(name="localidad_id", referencedColumnName="id")
     */
    private $localidad;

    /**
     * @var Postulante
     * @ORM\OneToOne(targetEntity="App\Models\Entities\Postulados\Postulante", fetch="EXTRA_LAZY", cascade={"ALL"})
     * @ORM\JoinColumn(name="postulante_id", referencedColumnName="id")
     */
    private $postulante;

    /**
     * @return string
     */
    public function getCalle(): string
    {
        return $this->calle;
    }

    /**
     * @param string $calle
     */
    public function setCalle(string $calle): void
    {
        $this->calle = $calle;
    }

    /**
     * @return int
     */
    public function getAltura(): int
    {
        return $this->altura;
    }

    /**
     * @param int $altura
     */
    public function setAltura(int $altura): void
    {
        $this->altura = $altura;
    }

    /**
     * @return string|null
     */
    public function getPiso(): ?string
    {
        return $this->piso;
    }

    /**
     * @param string|null $piso
     */
    public function setPiso(?string $piso): void
    {
        $this->piso = $piso;
    }

    /**
     * @return string|null
     */
    public function getDepto(): ?string
    {
        return $this->depto;
    }

    /**
     * @param string|null $depto
     */
    public function setDepto(?string $depto): void
    {
        $this->depto = $depto;
    }

    /**
     * @return Localidad
     */
    public function getLocalidad(): Localidad
    {
        return $this->localidad;
    }

    /**
     * @param Localidad $localidad
     */
    public function setLocalidad(Localidad $localidad): void
    {
        $this->localidad = $localidad;
    }

    public function jsonSerialize()
    {
        return [
            "id"            => $this->getId(),
            "calle"         => $this->calle,
            "altura"        => $this->altura,
            "piso"          => $this->piso,
            "depto"         => $this->depto,
            "localidad_id"     => $this->localidad->getId()
        ];
    }
}
