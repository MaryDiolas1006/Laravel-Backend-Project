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
        // 'App\Model' => 'App\Policies\ModelPolicy',
         'App\Subject' => 'App\Policies\SubjectPolicy',
        'App\Unit' => 'App\Policies\UnitPolicy',
        'App\Ticket' => 'App\Policies\TicketPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // this will define what user and admin need to see on the page
        Gate::define('isAdmin', function($user) {
            return $user->role_id === 1;
        });
    }
}
