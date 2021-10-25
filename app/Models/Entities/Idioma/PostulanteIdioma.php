<?php


namespace App\Models\Entities\Idioma;

use App\Models\Entities\Persistente;
use App\Models\Entities\Postulados\Postulante;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class PostulanteIdioma
 * @package App\Models\Entities\Idioma
 * @ORM\Entity
 * @ORM\Table(name="postulante_idioma")
 */
class PostulanteIdioma extends Persistente implements \JsonSerializable
{
    /**
     * @var Postulante
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Postulados\Postulante", fetch="EXTRA_LAZY", inversedBy="nivelesSobreIdioma")
     * @ORM\JoinColumn (name="postulante_id", referencedColumnName="id")
     */
    private Postulante $postulante;

    /**
     * @var Idioma
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Idioma\Idioma", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn (name="idioma_id", referencedColumnName="id")
     */
    private Idioma $idioma;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $nivelOral;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $nivelEscrito;

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
    public function setPostulante(Postulante $postulante): void
    {
        $this->postulante = $postulante;
    }

    /**
     * @return Idioma
     */
    public function getIdioma(): Idioma
    {
        return $this->idioma;
    }

    /**
     * @param Idioma $idioma
     */
    public function setIdioma(Idioma $idioma): void
    {
        $this->idioma = $idioma;
    }


    /**
     * @return string
     */
    public function getNivelOral(): string
    {
        return $this->nivelOral;
    }

    /**
     * @param string $nivelOral
     */
    public function setNivelOral(string $nivelOral): void
    {
        $this->nivelOral = $nivelOral;
    }

    /**
     * @return string
     */
    public function getNivelEscrito(): string
    {
        return $this->nivelEscrito;
    }

    /**
     * @param string $nivelEscrito
     */
    public function setNivelEscrito(string $nivelEscrito): void
    {
        $this->nivelEscrito = $nivelEscrito;
    }


    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "idioma" => $this->getIdioma(),
            "nivelOral" => $this->getNivelOral(),
            "nivelEscrito" => $this->getNivelEscrito(),
        ];
    }
}
