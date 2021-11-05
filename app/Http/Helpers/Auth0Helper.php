<?php

namespace App\Http\Helpers;

use App\Models\Repositories\RepositorioDeUsuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Auth0Helper
{
    private RepositorioDeUsuarios $repositorioDeUsuarios;
    private $domain;
    private $managementApi;
    private $baseUrl;
    private $bearerTokenManagementApi;
    private $clientId;
    private $clientSecret;

    public function __construct(RepositorioDeUsuarios $repositorioDeUsuarios)
    {
        $this->repositorioDeUsuarios    = $repositorioDeUsuarios;
        $this->domain                   = env('AUTH_DOMAIN');
        $this->managementApi            = env('AUTH0_MANAGEMENT_API');

    }
}
