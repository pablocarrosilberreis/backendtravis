<?php


namespace App\Models\Entities\Postulados;

use App\Models\Entities\Persistente;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Telefono
 * @package App\Models\Entities\Postulados
 * @ORM\Entity
 * @ORM\Table(name="telefono")
 */
class Telefono extends Persistente implements \JsonSerializable
{
    /**
     * @var string
     * @ORM\Column(name="telefono", type="string")
     */
    private $telefono;
    /**
     * @var string
     * @ORM\Column(name="codArea", type="string")
     */
    private $codArea;
    /**
     * @var Postulante
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Postulados\Postulante", fetch="EXTRA_LAZY", inversedBy="telefonos")
     * @ORM\JoinColumn(name="postulante_id", referencedColumnName="id")
     */
    private $postulante;

    /**
     * @param string $telefono
     */
    public function setTelefono(string $telefono): void
    {
        $this->telefono = $telefono;
    }

    /**
     * @return string
     */
    public function getTelefono(): string
    {
        return $this->telefono;
    }

    /**
     * @param string $codArea
     */
    public function setCodArea(string $codArea): void
    {
        $this->codArea = $codArea;
    }

    /**
     * @return string
     */
    public function getCodArea(): string
    {
        return $this->codArea;
    }

    /**
     * @return Postulante
     */
    public function getPostulante(): Postulante
    {
        return $this->postulante;
    }

    /**
     * @param Postulante $postulante
     */
    public function setPostulante(Postulante $postulante)
    {
        $this->postulante = $postulante;
    }

    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "telefono" => $this->getTelefono(),
            "cod_area" => $this->getCodArea()
        ];
    }
}
