<?php

namespace FindBrok\TradeoffAnalytics;

use FindBrok\TradeoffAnalytics\Contracts\TradeoffAnalyticsInterface;
use FindBrok\TradeoffAnalytics\Support\DataCollection;
use FindBrok\WatsonBridge\Bridge;
use Illuminate\Support\ServiceProvider;

/**
 * Class TradeoffAnalyticsServiceProvider
 *
 * @package FindBrok\TradeoffAnalytics
 */
class TradeoffAnalyticsServiceProvider extends ServiceProvider
{
    /**
     * Interfaces and their concrete classes
     *
     * @var array
     */
    protected $binds = [
        TradeoffAnalyticsInterface::class => Engine::class
    ];

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        //Publish config files
        $this->publishes([
            $this->ourConfigPath('tradeoff-analytics.php') => config_path('tradeoff-analytics.php')
        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //Merge config files
        $this->mergeConfigFrom(
            $this->ourConfigPath('tradeoff-analytics.php'), 'tradeoff-analytics'
        );

        //Register bindings
        $this->registerBindings();
        //Register Bridge
        $this->registerWatsonBridge();
        //Register Data Collectors
        $this->registerDataCollections();
    }

    /**
     * Register bindings
     *
     * @return void
     */
    public function registerBindings()
    {
        collect($this->binds)->each(function ($item, $key) {
            $this->app->bind($key, $item);
        });
    }

    /**
     * Register Watson Bridge
     *
     * @return void
     */
    public function registerWatsonBridge()
    {
        //Register Bridge
        $this->app->bind('TradeoffAnalyticsBridge', function ($app, $args = []) {
            return new Bridge(
                $args['username'],
                $args['password'],
                $args['url']
            );
        });
    }

    /**
     * Register all data Collectors
     *
     * @return void
     */
    public function registerDataCollections()
    {
        //Register Problem object
        $this->app->bind('TradeoffAnalyticsProblem', function ($app, $items = []) {
            return new DataCollection\Problem($items);
        });
        //Register ProblemColumn object
        $this->app->bind('TradeoffAnalyticsProblemColumn', function ($app, $items = []) {
            return new DataCollection\ProblemColumn($items);
        });
        //Register ProblemOption Object
        $this->app->bind('TradeoffAnalyticsProblemOption', function ($app, $items = []) {
            return new DataCollection\ProblemOption($items);
        });
        //Register ProblemColumnCategoricalRange object
        $this->app->bind('TradeoffAnalyticsProblemColumnCategoricalRange', function ($app, $items) {
            return new DataCollection\ProblemColumnCategoricalRange($items);
        });
    }

    /**
     * Gets our config path for package
     *
     * @param string $fileName
     * @return string
     */
    public function ourConfigPath($fileName = '')
    {
        return __DIR__.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.$fileName;
    }
}
