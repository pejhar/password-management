<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Services\Auth\JsonGuard;
use App\Extensions\NoSqlUserProvider;
use App\Database\Auth\UserDatabase;
use App\Database\Vault\PasswordDatabase;
use App\Database\Vault\PasswordTypeDatabase;
use App\Models\Auth\User;
use App\Models\Vault\Password;
use App\Models\Vault\PasswordType;

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

        // bind user dtabase
        $this->app->bind('App\Database\Auth\UserDatabase', function ($app) {
            return new UserDatabase(config('nosql.defaults.db_path'), config('nosql.defaults.user_file'));
        });
        $this->app->bind('App\Models\Auth\User', function ($app) {
            return new User($app->make('App\Database\Auth\UserDatabase'));
        });

        // bind password dtabase
        $this->app->bind('App\Database\Vault\PasswordDatabase', function ($app) {
            return new PasswordDatabase(config('nosql.defaults.db_path'), config('nosql.defaults.password_file'));
        });
        $this->app->bind('App\Models\Vault\Password', function ($app) {
            return new Password($app->make('App\Database\Vault\PasswordDatabase'));
        });

        // bind password type dtabase
        $this->app->bind('App\Database\Vault\PassworTypeDatabase', function ($app) {
            return new PasswordTypeDatabase(config('nosql.defaults.db_path'), config('nosql.defaults.password_type_file'));
        });
        $this->app->bind('App\Models\Vault\PasswordType', function ($app) {
            return new PasswordType($app->make('App\Database\Vault\PassworTypeDatabase'));
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
            'App\Database\Auth\UserDatabase',
            'App\Database\Vault\PasswordDatabase',
            'App\Database\Vault\PasswordTypeDatabase',
        );
    }
}
