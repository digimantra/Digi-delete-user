<?php
namespace appdigidelete\AccountDeletion;

use Illuminate\Support\ServiceProvider;

class AccountDeletionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/config/config.php', 'accountdeletion');

        $this->publishes([
            __DIR__.'/config/config.php' => config_path('accountdeletion.php'),
        ], 'config');

        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        // Load views from the package
        $this->loadViewsFrom(__DIR__.'/resources/views', 'digi_deleteUser'); // Adjust the namespace as needed
    }

    

    public function register()
    {
        // Register any bindings or singletons
    }
}
