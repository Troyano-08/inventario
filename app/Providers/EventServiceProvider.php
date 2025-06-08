<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Los listener para los eventos de tu aplicación.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Registra cualquier evento para tu aplicación.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determina si se debe descubrir automáticamente eventos y listeners.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
