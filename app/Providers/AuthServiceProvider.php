<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('users', function ($user) {
            return $user->hasPermission('users');
        });

        Gate::define('add_permissions_users', function ($user) {
            return $user->hasPermission('add_permissions_users');
        });

        Gate::define('deletar_permissao_usuario', function ($user) {
            return $user->hasPermission('deletar_permissao_usuario');
        });

        Gate::before(function ($user) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });
    }
}
