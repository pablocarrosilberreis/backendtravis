<?php

namespace App\Models\Entities\Publicaciones;

use App\Models\Entities\Persistente;
use App\Models\Entities\Postulados\Usuario;
use Illuminate\Support\Facades\Date;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class PublicacionEstado
 * @package App\Models\Entities\Publicaciones
 * @ORM\Entity(repositoryClass="App\Models\Repositories\RepositorioDePublicacionEstados")
 * @ORM\Table(name="publicacion_estado")
 */
class PublicacionEstado extends Persistente implements \JsonSerializable
{
    /**
     * @var Publicacion
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Publicaciones\Publicacion", fetch="EXTRA_LAZY", inversedBy="publicacionEstados")
     * @ORM\JoinColumn(name="publicacion_id", referencedColumnName="id")
     */
    private Publicacion $publicacion;

    /**
     * @var Estado
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Publicaciones\Estado", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id")
     */
    private Estado $estado;

    /**
     * @var \DateTime
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var Usuario
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Postulados\Usuario", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     */
    private Usuario $usuario;

    /**
     * @return Publicacion
     */
    public function getPublicacion(): Publicacion
    {
        return $this->publicacion;
    }

    /**
     * @param Publicacion $publicacion
     */
    public function setPublicacion(Publicacion $publicacion): void
    {
        $this->publicacion = $publicacion;
    }

    /**
     * @return Estado
     */
    public function getEstado(): Estado
    {
        return $this->estado;
    }

    /**
     * @param Estado $estado
     */
    public function setEstado(Estado $estado): void
    {
        $this->estado = $estado;
    }

    /**
     * @return \DateTime
     */
    public function getFecha(): \DateTime
    {
        return $this->fecha;
    }

    /**
     * @param \DateTime $fecha
     */
    public function setFecha(\DateTime $fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return Usuario
     */
    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }

    /**
     * @param Usuario $usuario
     */
    public function setUsuario(Usuario $usuario): void
    {
        $this->usuario = $usuario;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'publicacion_id' => $this->getPublicacion()->getId(),
            'estado' => $this->getEstado()->getNombre(),
            'fecha' => $this->getFecha(),
            'usuario_id' => $this->getUsuario()->getId()
        ];
    }
}
