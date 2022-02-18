<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        $this->registerPolicies();
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');

        Gate::define('isAdmin', function ($user) {
            return $user->role == 'admin';
        });
        Gate::define('isMain', function ($user) {
            return $user->role == 'mainstore';
        });
        Gate::define('isSub', function ($user) {
            return $user->role == 'substore';
        });


        //
    }
}
