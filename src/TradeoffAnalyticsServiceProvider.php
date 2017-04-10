<?php

namespace FindBrok\TradeoffAnalytics;

use Illuminate\Support\ServiceProvider;
use FindBrok\WatsonBridge\Support\Carpenter;
use FindBrok\TradeoffAnalytics\Contracts\TradeoffAnalytics;

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

        // Registers the default Watson bridge for
        // Communicating with Tradeoff Analytics.
        $this->app->bind(TradeoffAnalytics::class, function ($app) {
            return $this->buildDefaultBridge();
        });
    }

    /**
     * Build and return the default bridge.
     *
     * @return \FindBrok\WatsonBridge\Bridge
     */
    public function buildDefaultBridge()
    {
        /** @var Carpenter $carpenter */
        $carpenter = $this->app->make(Carpenter::class);

        // Get Default Bridge name.
        $defaultBridgeName = config('tradeoff-analytics.default_bridge');

        // Get Bridge definition.
        $bridgeDefinition = config('tradeoff-analytics.bridges.'.$defaultBridgeName);

        // Return new Bridge
        return $carpenter->constructBridge(
            $bridgeDefinition['credential_name'], $bridgeDefinition['service'], $bridgeDefinition['auth_method']
        );
    }
}
