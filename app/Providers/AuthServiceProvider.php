<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
     protected $policies = [];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('sindicato', function ($user) {
            return $user->isSindicato();
        });

        Gate::define('empresa', function ($user) {
            return $user->isEmpresa();
        });

        Gate::define('empresa_parceira', function ($user) {
            return $user->isEmpresaParceira();
        });

        Gate::define('trabalhador', function ($user) {
            return $user->isTrabalhador();
        });
    }
}
