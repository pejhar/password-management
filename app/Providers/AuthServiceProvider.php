<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Services\Auth\JsonGuard;
use App\Extensions\NoSqlUserProvider;
use App\Database\Auth\UserDatabase;
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


    public function register()
    {
        $this->app->bind(
            'App\Services\Contracts\NosqlServiceInterface',
            'App\Database\Auth\UserDatabase',
        );
    }


    /**
   * Register any authentication / authorization services.
   *
   * @return void
   */
    public function boot()
    {
        $this->registerPolicies();

        // bind user dtabase
        $this->app->bind('App\Database\Auth\UserDatabase', function ($app) {
            return new UserDatabase(config('nosql.defaults.db_path'), config('nosql.defaults.user_file'));
        });
        $this->app->bind('App\Models\Auth\User', function ($app) {
            return new User($app->make('App\Database\Auth\UserDatabase'));
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

    
}
