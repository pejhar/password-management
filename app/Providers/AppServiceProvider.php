<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Database\Vault\PasswordDatabase;
use App\Database\Vault\PasswordTypeDatabase;
use App\Models\Vault\Password;
use App\Models\Vault\PasswordType;

class AppServiceProvider extends ServiceProvider
{

    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Database\Vault\PasswordDatabase',
            'App\Database\Vault\PasswordTypeDatabase',
        );
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

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
    }


}
