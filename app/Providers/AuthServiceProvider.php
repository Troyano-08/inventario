<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Las políticas de autorización de tu aplicación.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Registra cualquier servicio de autenticación/autorización.
     */
    public function boot()
    {
        $this->registerPolicies();

        // Puedes definir aquí tus Gates si deseas
        // Gate::define('ver-dashboard', fn($user) => $user->is_admin);
    }
}
