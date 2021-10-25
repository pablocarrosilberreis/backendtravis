<?php

namespace App\Models\Entities\Postulados;

use App\Models\Entities\Activable;
use App\Models\Entities\Persistente;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Usuario
 * @package App\Models\Entities\Postulados
 * @ORM\Entity(repositoryClass="App\Models\Repositories\RepositorioDeUsuarios")
 * @ORM\Table(name="usuario")
 */
class Usuario extends Activable implements \JsonSerializable
{
    /**
     * @var string
     * @ORM\Column(name="usuarioExterno", type="string")
     */
    private string $usuarioExterno;

    /**
     * @var \DateTime
     * @ORM\Column(name="ultimaFechaConexion", type="datetime")
     */
    private \DateTime $ultimaConexion;

    /**
     * @return string
     */
    public function getUsuarioExterno(): string
    {
        return $this->usuarioExterno;
    }

    /**
     * @param string $usuarioExterno
     */
    public function setUsuarioExterno(string $usuarioExterno): void
    {
        $this->usuarioExterno = $usuarioExterno;
    }

    /**
     * @return \DateTime
     */
    public function getUltimaConexion(): \DateTime
    {
        return $this->ultimaConexion;
    }

    /**
     * @param \DateTime $ultimaConexion
     */
    public function setUltimaConexion(\DateTime $ultimaConexion): void
    {
        $this->ultimaConexion = $ultimaConexion;
    }

    public function jsonSerialize()
    {
        return [
            "id"                    => $this->getId(),
            "activo"                => $this->isActivo(),
            "usuarioExterno"        => $this->getUsuarioExterno(),
            "ultimaConexion"        => $this->getUltimaConexion(),
        ];
    }
}
