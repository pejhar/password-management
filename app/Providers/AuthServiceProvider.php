<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Services\Auth\JsonGuard;
use App\Extensions\NoSqlUserProvider;
use App\Database\NoSqlDatabase;
use App\Models\Auth\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
   * The policy mappings for the application.
   *
   * @var array
   */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
   * Register any authentication / authorization services.
   *
   * @return void
   */
    public function boot()
    {
        $this->registerPolicies();

        $this->app->bind('App\Database\NoSqlDatabase', function ($app) {
            return new NoSqlDatabase(config('nosql.defaults.host'), config('nosql.defaults.port'), config('nosql.defaults.database'));
        });

        $this->app->bind('App\Models\Auth\User', function ($app) {
            return new User($app->make('App\Database\NoSqlDatabase'));
        });

        // add custom guard provider
        Auth::provider('nosql', function ($app, array $config) {
            return new NoSqlUserProvider($app->make('App\Models\Auth\User'));
        });

        // add custom guard
        Auth::extend('json', function ($app, $name, array $config) {
            return new JsonGuard(Auth::createUserProvider($config['provider']), $app->make('request'));
        });
    }

    public function register()
    {
        $this->app->bind(
            'App\Services\Contracts\NosqlServiceInterface',
            'App\Database\NoSqlDatabase'
        );
    }
}
