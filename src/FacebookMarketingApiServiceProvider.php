<?php

namespace EolabsIo\FacebookMarketingApi;

use EolabsIo\FacebookMarketingApi\Domain\Reporting\Command\AdInsightsCommand;
use Illuminate\Support\ServiceProvider;
use EolabsIo\FacebookMarketingApi\FacebookMarketingApi;
use EolabsIo\FacebookMarketingApi\Domain\Reporting\Insights;

class FacebookMarketingApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('facebook-marketing-api.php'),
            ], 'config');
        }

        if ($this->app->runningInConsole()) {
            if (FacebookMarketingApi::$runsMigrations) {
                $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
            }

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations/facebookMarketingApi'),
            ], 'facebook-marketing-api-migrations');

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('facebook-marketing-api.php'),
            ], 'facebook-marketing-api-config');

            // Registering package commands.
            $this->commands([
                AdInsightsCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'facebook-marketing-api');

        // Register the main class to use with the facade
        $this->app->singleton('facebook-marketing-api', function () {
            return new FacebookMarketingApi;
        });

        $this->app->singleton(Insights::class, function () {
            return new Insights;
        });
    }
}
