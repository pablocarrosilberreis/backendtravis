<?php

namespace App\Providers;

use App\Models\Entities\Idioma\Idioma;
use App\Models\Entities\Postulados\EstadoDelPostulante;
use App\Models\Entities\Postulados\ExperienciaLaboral;
use App\Models\Entities\Postulados\Postulante;
use App\Models\Entities\Postulados\PostulanteCV;
use App\Models\Entities\Postulados\PostulanteGenero;
use App\Models\Entities\Postulados\TipoDeDocumento;
use App\Models\Entities\Postulados\TipoDeEstadoDelPostulante;
use App\Models\Entities\Postulados\Usuario;
use App\Models\Entities\Publicaciones\Empresa;
use App\Models\Entities\Publicaciones\Estado;
use App\Models\Entities\Publicaciones\Publicacion;
use App\Models\Entities\Publicaciones\PublicacionCategoria;
use App\Models\Entities\Publicaciones\PublicacionEstado;
use App\Models\Entities\Publicaciones\PublicacionModalidadContrato;
use App\Models\Entities\Publicaciones\PublicacionPostulante;
use App\Models\Entities\Ubicacion\Localidad;
use App\Models\Entities\Ubicacion\Municipio;
use App\Models\Entities\Ubicacion\Pais;
use App\Models\Entities\Ubicacion\Provincia;
use App\Models\Repositories\RepositorioDeCategoriasDePublicaciones;
use App\Models\Repositories\RepositoriodeEmpresas;
use App\Models\Repositories\RepositorioDeEstados;
use App\Models\Repositories\RepositorioDeEstadosDelPostulantes;
use App\Models\Repositories\RepositorioDeExperienciasLaborales;
use App\Models\Repositories\RepositorioDeIdioma;
use App\Models\Repositories\RepositorioDeLocalidades;
use App\Models\Repositories\RepositorioDeMunicipios;
use App\Models\Repositories\RepositorioDePaises;
use App\Models\Repositories\RepositorioDePostulanteCVs;
use App\Models\Repositories\RepositorioDePostulanteGeneros;
use App\Models\Repositories\RepositorioDePostulantes;
use App\Models\Repositories\RepositorioDeProvincias;
use App\Models\Repositories\RepositorioDePublicaciones;
use App\Models\Repositories\RepositorioDePublicacionesPostulantes;
use App\Models\Repositories\RepositorioDePublicacionEstados;
use App\Models\Repositories\RepositorioDePublicacionModalidadesContratos;
use App\Models\Repositories\RepositorioDeTipoDeDocumento;
use App\Models\Repositories\RepositorioDeTiposEstadosDelPostulantes;
use App\Models\Repositories\RepositorioDeUsuarios;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private $repositorios = [
        RepositorioDePaises::class => Pais::class,
        RepositorioDeProvincias::class => Provincia::class,
        RepositorioDeMunicipios::class => Municipio::class,
        RepositorioDeLocalidades::class => Localidad::class,
        RepositorioDeCategoriasDePublicaciones::class => PublicacionCategoria::class,
        RepositorioDePostulantes::class => Postulante::class,
        RepositorioDeTipoDeDocumento::class => TipoDeDocumento::class,
        RepositorioDeIdioma::class => Idioma::class,
        RepositorioDeExperienciasLaborales::class => ExperienciaLaboral::class,
        RepositoriodeEmpresas::class => Empresa::class,
        RepositorioDeEstados::class => Estado::class,
        RepositorioDeEstadosDelPostulantes::class => EstadoDelPostulante::class,
        RepositorioDePostulanteCVs::class => PostulanteCV::class,
        RepositorioDePublicaciones::class => Publicacion::class,
        RepositorioDePublicacionesPostulantes::class => PublicacionPostulante::class,
        RepositorioDePublicacionEstados::class => PublicacionEstado::class,
        RepositorioDePublicacionModalidadesContratos::class => PublicacionModalidadContrato::class,
        RepositorioDeTiposEstadosDelPostulantes::class => TipoDeEstadoDelPostulante::class,
        RepositorioDeUsuarios::class => Usuario::class,
        RepositorioDePostulanteGeneros::class => PostulanteGenero::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositorios as $repositorio => $entidad) {
            $this->app->bind($repositorio, function($app) use($repositorio, $entidad){
                return new $repositorio($app['em'], $app['em']->getClassMetaData($entidad));
            });
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
