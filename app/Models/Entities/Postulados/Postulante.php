<?php


namespace App\Models\Entities\Postulados;


use App\Models\Entities\Activable;
use App\Models\Entities\Idioma\PostulanteIdioma;
use App\Models\Entities\Publicaciones\Publicacion;
use App\Models\Entities\Publicaciones\PublicacionCategoria;
use App\Models\Entities\Ubicacion\Direccion;
use App\Models\Entities\Ubicacion\Pais;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * Class Postulante
 * @package App\Models\Entities\Postulado
 * @ORM\Entity(repositoryClass="App\Models\Repositories\RepositorioDePostulantes")
 * @ORM\Table(name="postulante")
 */
class Postulante extends Activable implements \JsonSerializable
{
    /**
     * @var string
     * @ORM\Column(name="nombre", type="string")
     */
    private $nombre;
    /**
     * @var string
     * @ORM\Column(name="apellido", type="string")
     */
    private $apellido;
    /**
     * @var string
     * @ORM\Column(name="email", type="string")
     */
    private $email;
    /**
     * @var \DateTime
     * @ORM\Column(name="fechaNacimiento", type="date")
     */
    private $fechaDeNacimiento;
    /**
     * @var PostulanteGenero
     * @ORM\OneToOne(targetEntity="App\Models\Entities\Postulados\PostulanteGenero", fetch="EXTRA_LAZY", cascade={"ALL"})
     * @ORM\JoinColumn(name="genero_id", referencedColumnName="id")
     */
    private PostulanteGenero $genero;
    /**
     * @var Direccion
     * @ORM\OneToOne(targetEntity="App\Models\Entities\Ubicacion\Direccion", fetch="EXTRA_LAZY", cascade={"ALL"})
     * @ORM\JoinColumn(name="direccion_id", referencedColumnName="id")
     */
    private Direccion $direccion;
    /**
     * @var Pais[]|ArrayCollection|PersistentCollection
     * @ORM\ManyToMany(targetEntity="App\Models\Entities\Ubicacion\Pais", fetch="EXTRA_LAZY", cascade={"ALL"})
     * @ORM\JoinTable(
     *     name="postulante_nacionalidad",
     *     joinColumns={@ORM\JoinColumn(name="postulante_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="pais_id", referencedColumnName="id")}
     * )
     */
    private $nacionalidades;
    /**
     * @var boolean
     * @ORM\Column(name="disponibilidadViaje", type="boolean")
     */
    private $disponibilidadParaViajar = false;
    /**
     * @var boolean
     * @ORM\Column(name="aceptado", type="boolean")
     */
    private $aceptado = false;
    /**
     * @var \DateTime|null
     * @ORM\Column(name="fechaUltConexion", type="datetime", columnDefinition="DATETIME on update CURRENT_TIMESTAMP")
     */
    private $fechaUltimaConexion;
    /**
     * @var string
     * @ORM\Column(name="nroDocumento", type="string")
     */
    private $nroDocumento;
    /**
     * @var TipoDeDocumento
     * @ORM\ManyToOne(targetEntity="App\Models\Entities\Postulados\TipoDeDocumento", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="tipoDocumento_id", referencedColumnName="id")
     */
    private $tipoDocumento;
    /**
     * @var PublicacionCategoria[]|ArrayCollection|PersistentCollection
     * @ORM\ManyToMany(targetEntity="App\Models\Entities\Publicaciones\PublicacionCategoria", fetch="EXTRA_LAZY", cascade={"ALL"})
     * @ORM\JoinTable(
     *     name="postulante_interes",
     *     joinColumns={@ORM\JoinColumn(name="postulante_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="publicacion_categoria_id", referencedColumnName="id")}
     * )
     */
    private $intereses;
    /**
     * @var Publicacion[]|ArrayCollection|PersistentCollection
     * @ORM\ManyToMany(targetEntity="App\Models\Entities\Publicaciones\Publicacion", fetch="EXTRA_LAZY", cascade={"ALL"})
     * @ORM\JoinTable(
     *     name="favoritos",
     *     joinColumns={@ORM\JoinColumn(name="postulante_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="publicacion_id", referencedColumnName="id")}
     * )
     */
    private $favoritos;
    /**
     * @var PostulanteIdioma[]|ArrayCollection|PersistentCollection
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Idioma\PostulanteIdioma", fetch="EXTRA_LAZY", mappedBy="postulante", cascade={"ALL"})
     */
    private $nivelesSobreIdioma;
    /**
     * @var Telefono[]|ArrayCollection|PersistentCollection
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Postulados\Telefono", fetch="EXTRA_LAZY", mappedBy="postulante", cascade={"ALL"})
     * @@ORM\JoinColumn(name="telefono_id", referencedColumnName="id")
     */
    private $telefonos;

    /**
     * @var ExperienciaLaboral[]|ArrayCollection|PersistentCollection
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Postulados\ExperienciaLaboral", fetch="EXTRA_LAZY", mappedBy="postulante", cascade={"ALL"})
     */
    private $experienciasLaborales;

    /**
     * @var Usuario
     * @ORM\OneToOne(targetEntity="App\Models\Entities\Postulados\Usuario")
     */
    private $usuario;

    /**
     * @var EstadoDelPostulante[]|ArrayCollection|PersistentCollection
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Postulados\EstadoDelPostulante", fetch="EXTRA_LAZY", mappedBy="postulante", cascade={"ALL"})
     */
    private $estadoPostulante;

    /**
     * @var PostulanteCV[]|ArrayCollection|PersistentCollection
     * @ORM\OneToMany(targetEntity="App\Models\Entities\Postulados\PostulanteCV", fetch="EXTRA_LAZY", mappedBy="postulante", cascade={"ALL"})
     */
    private $postulanteCVs;

    public function __construct()
    {
        $this->direccion = new Direccion();
        $this->nacionalidades = new ArrayCollection();
        $this->nivelesSobreIdioma = new ArrayCollection();
        $this->telefonos = new ArrayCollection();
        $this->intereses = new ArrayCollection();
        $this->favoritos = new ArrayCollection();
        $this->experienciasLaborales = new ArrayCollection();
        $this->estadoPostulante = new ArrayCollection();
        $this->postulanteCVs = new ArrayCollection();
    }

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

    /**
     * @return string
     */
    public function getApellido(): string
    {
        return $this->apellido;
    }

    /**
     * @param string $apellido
     */
    public function setApellido(string $apellido): void
    {
        $this->apellido = $apellido;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return \DateTime
     */
    public function getFechaDeNacimiento(): \DateTime
    {
        return $this->fechaDeNacimiento;
    }

    /**
     * @param \DateTime $fechaDeNacimiento
     */
    public function setFechaDeNacimiento(\DateTime $fechaDeNacimiento): void
    {
        $this->fechaDeNacimiento = $fechaDeNacimiento;
    }

    /**
     * @return PostulanteGenero
     */
    public function getGenero(): PostulanteGenero
    {
        return $this->genero;
    }

    /**
     * @param PostulanteGenero $genero
     */
    public function setGenero(PostulanteGenero $genero): void
    {
        $this->genero = $genero;
    }

    /**
     * @return Direccion
     */
    public function getDireccion(): Direccion
    {
        return $this->direccion;
    }

    /**
     * @param Direccion $direccion
     */
    public function setDireccion(Direccion $direccion): void
    {
        $this->direccion = $direccion;
    }

    /**
     * @return Pais[]|ArrayCollection|PersistentCollection
     */
    public function getNacionalidades()
    {
        return $this->nacionalidades;
    }

    /**
     * @param Pais[]|ArrayCollection|PersistentCollection $nacionalidades
     */
    public function setNacionalidades($nacionalidades): void
    {
        $this->nacionalidades = $nacionalidades;
    }

    /**
     * @return bool
     */
    public function isDisponibilidadParaViajar(): bool
    {
        return $this->disponibilidadParaViajar;
    }

    /**
     * @param bool $disponibilidadParaViajar
     */
    public function setDisponibilidadParaViajar(bool $disponibilidadParaViajar): void
    {
        $this->disponibilidadParaViajar = $disponibilidadParaViajar;
    }

    /**
     * @return bool
     */
    public function isAceptado(): bool
    {
        return $this->aceptado;
    }

    /**
     * @param bool $aceptado
     */
    public function setAceptado(bool $aceptado): void
    {
        $this->aceptado = $aceptado;
    }

    /**
     * @return \DateTime|null
     */
    public function getFechaUltimaConexion(): ?\DateTime
    {
        return $this->fechaUltimaConexion;
    }

    /**
     * @param \DateTime|null $fechaUltimaConexion
     */
    public function setFechaUltimaConexion(?\DateTime $fechaUltimaConexion): void
    {
        $this->fechaUltimaConexion = $fechaUltimaConexion;
    }

    /**
     * @return string
     */
    public function getNroDocumento(): string
    {
        return $this->nroDocumento;
    }

    /**
     * @param string $nroDocumento
     */
    public function setNroDocumento(string $nroDocumento): void
    {
        $this->nroDocumento = $nroDocumento;
    }

    /**
     * @return TipoDeDocumento
     */
    public function getTipoDocumento(): TipoDeDocumento
    {
        return $this->tipoDocumento;
    }

    /**
     * @param TipoDeDocumento $tipoDocumento
     */
    public function setTipoDocumento(TipoDeDocumento $tipoDocumento): void
    {
        $this->tipoDocumento = $tipoDocumento;
    }

    /**
     * @return PublicacionCategoria[]|ArrayCollection|PersistentCollection
     */
    public function getIntereses()
    {
        return $this->intereses;
    }

    public function agregarCategoria(PublicacionCategoria $categoria)
    {
        if(!$this->intereses->contains($categoria))
        {
            $this->intereses->add($categoria);
        }
    }

    /**
     * @return Publicacion[]|ArrayCollection|PersistentCollection
     */
    public function getFavoritos()
    {
        return $this->favoritos;
    }

    /**
     * @param Publicacion[]|ArrayCollection|PersistentCollection $favoritos
     */
    public function agregarFavoritos($favoritos): void
    {
        if(!$this->getFavoritos()->contains($favoritos))
        {
            $this->getFavoritos()->add($favoritos);
        }
    }

    /**
     * @param Pais $pais
     */
    public function agregarNacionalidades(Pais $pais)
    {
        if(!$this->nacionalidades->contains($pais))
        {
            $this->nacionalidades->add($pais);
        }
    }

    /**
     * @return PostulanteIdioma[]|ArrayCollection|PersistentCollection
     */
    public function getNivelesSobreIdioma()
    {
        return $this->nivelesSobreIdioma;
    }

    /**
     * @param PostulanteIdioma $unNivelDeIdioma
     */
    public function agregarNivelDeIdioma(PostulanteIdioma $unNivelDeIdioma)
    {
        if(!$this->nivelesSobreIdioma->contains($unNivelDeIdioma))
        {
            $this->nivelesSobreIdioma->add($unNivelDeIdioma);
            $unNivelDeIdioma->setPostulante($this);
        }
    }

    /**
     * @return Telefono[]|ArrayCollection|PersistentCollection
     */
    public function getTelefonos()
    {
        return $this->telefonos;
    }

    /**
     * @param Telefono $unTelefono
     */
    public function agregarTelefono(Telefono $unTelefono)
    {
        $this->telefonos->add($unTelefono);
        $unTelefono->setPostulante($this);
    }

    /**
     * @return ExperienciaLaboral[]|ArrayCollection|PersistentCollection
     */
    public function getExperienciasLaborales()
    {
        return $this->experienciasLaborales;
    }

    /**
     * @param ExperienciaLaboral[]|ArrayCollection|PersistentCollection $experienciasLaborales
     */
    public function agregarExperienciasLaborales($experienciaLaboral): void
    {
        if(!$this->getExperienciasLaborales()->contains($experienciaLaboral))
        {
            $this->getExperienciasLaborales()->add($experienciaLaboral);
        }
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

    /**
     * @return EstadoDelPostulante[]|ArrayCollection|PersistentCollection
     */
    public function getEstadoPostulante()
    {
        return $this->estadoPostulante;
    }

    /**
     * @param EstadoDelPostulante[]|ArrayCollection|PersistentCollection $estadoPostulante
     */
    public function agregarEstadoPostulante($estadoPostulante): void
    {
        if(!$this->getEstadoPostulante()->contains($estadoPostulante))
        {
            $this->getEstadoPostulante()->add($estadoPostulante);
        }
    }

    /**
     * @return PostulanteCV[]|ArrayCollection|PersistentCollection
     */
    public function getPostulanteCVs()
    {
        return $this->postulanteCVs;
    }

    /**
     * @param PostulanteCV
     */
    public function agregarCV($postulanteCV): void
    {
        if(!$this->getPostulanteCVs()->contains($postulanteCV))
        {
            $this->getPostulanteCVs()->add($postulanteCV);
        }
    }

    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "activo" => $this->isActivo(),
            "nombre" => $this->getNombre(),
            "apellido" => $this->getApellido(),
            "email" => $this->getEmail(),
            "fecha_nacimiento" => $this->getFechaDeNacimiento(),
            "genero_id" => $this->getGenero(),
            "direccion" => $this->getDireccion(),
            "nacionalidades" => $this->getNacionalidades()->toArray(),
            "disponibilidad_viaje" => $this->isDisponibilidadParaViajar(),
            "aceptado" => $this->isAceptado(),
            "fecha_ult_conexion" => $this->getFechaUltimaConexion(),
            "tipo_documento" => $this->getTipoDocumento(),
            "intereses" => $this->getIntereses()->toArray(),
            "favoritos" => $this->getFavoritos()->toArray(),
            "niveles_idioma" => $this->getNivelesSobreIdioma()->toArray(),
            "telefonos" => $this->getTelefonos()->toArray(),
            "experienciaLaboral" => $this->getExperienciasLaborales()->toArray(),
            "usuario_id" => $this->getUsuario()->getId(),
        ];
    }
}
