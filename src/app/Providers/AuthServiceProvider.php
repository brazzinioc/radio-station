<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

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

        //Rewrite VerifyEmail notification
        VerifyEmail::toMailUsing(function ($notifiable, $url) {

            $urlSplit = explode('/', $url);
            $url = config('app.url') . "/verify-account/{$urlSplit[6]}/{$urlSplit[7]}";

            return (new MailMessage)
                    ->subject( config('app.name') . ' | Confirma tu cuenta')
                    ->greeting('Hola!')
                    ->line('Por favor, confirma tu cuenta haciendo click en el botón "Confirmar".')
                    ->action('Confirmar', $url);
        });
    }
}
