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

        //

        Gate::define('is-admin', function ($user) {

           return $user->isAdmin();
        });
        Gate::define('is-prefet', function ($user) {

           return $user->isPrefet();
        });
        Gate::define('is-professeur', function ($user) {

           return $user->isProfesseur();
        });
        Gate::define('is-bibliothequaire', function ($user) {

           return $user->isBibliothequaire();
        });
        Gate::define('is-parent', function ($user) {

           return $user->isParent();
        });
        Gate::define('is-directeur', function ($user) {

           return $user->isDirecteur();
        });
        Gate::define('is-comptable', function ($user) {

           return $user->isComptable();
        });
        Gate::define('is-secretaire', function ($user) {
           return $user->isSecretaire();
        });
        Gate::define('is-cantine', function ($user) {
           return $user->isCantine();
        });    
    }
}
