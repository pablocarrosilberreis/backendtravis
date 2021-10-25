<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('paises', \App\Http\Controllers\API\Ubicacion\PaisesController::class)
    ->only(['index', 'show'])
    ->middleware(['prueba']);

Route::resource('paises.provincias', \App\Http\Controllers\API\Ubicacion\ProvinciasController::class)
    ->shallow()
    ->except(['store', 'update']);

Route::resource('provincias.municipios', \App\Http\Controllers\API\Ubicacion\MunicipiosController::class)
    ->shallow()
    ->only(['index', 'show']);

Route::resource('municipios.localidades', \App\Http\Controllers\API\Ubicacion\LocalidadesController::class)
    ->shallow()
    ->only(['index', 'show']);

Route::resource('categorias-publicaciones', \App\Http\Controllers\API\Publicacion\CategoriasPublicacionesController::class);

Route::resource('estados-publicaciones', \App\Http\Controllers\API\Publicacion\PublicacionEstadosController::class);

Route::resource('posible-estados-publicaciones', \App\Http\Controllers\API\Publicacion\EstadosController::class);

Route::resource('modalidades-contratos', \App\Http\Controllers\API\Publicacion\PublicacionModalidadesContratosController::class)
    ->shallow()
    ->only(['index', 'show']);

Route::resource('postulantes', \App\Http\Controllers\API\Postulado\PostulantesController::class);

Route::resource('publicaciones', \App\Http\Controllers\API\Publicacion\PublicacionesController::class);

Route::resource('empresas', \App\Http\Controllers\API\Publicacion\EmpresasController::class);

Route::resource("usuarios", \App\Http\Controllers\API\Postulado\UsuarioController::class);

