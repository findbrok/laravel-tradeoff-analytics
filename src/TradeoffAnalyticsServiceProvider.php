<?php

namespace FindBrok\TradeoffAnalytics;

use FindBrok\WatsonBridge\Bridge;
use Illuminate\Support\ServiceProvider;
use FindBrok\TradeoffAnalytics\Contracts\TradeoffAnalyticsInterface;

class TradeoffAnalyticsServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        // Make sure we are running in
        // console first.
        if ($this->app->runningInConsole()) {
            // Publish config files.
            $this->publishes([
                __DIR__.'/../config/tradeoff-analytics.php' => config_path('tradeoff-analytics.php'),
            ], 'watson-tradeoff-analytics');
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Merge config files.
        $this->mergeConfigFrom(__DIR__.'/../config/tradeoff-analytics.php', 'tradeoff-analytics');

        // Register engine.
        $this->app->bind(TradeoffAnalyticsInterface::class, Engine::class);

        // Register Bridge.
        $this->app->bind('TradeoffAnalyticsBridge', function ($app, $args = []) {
            return new Bridge($args['username'], $args['password'], $args['url']);
        });
    }
}
