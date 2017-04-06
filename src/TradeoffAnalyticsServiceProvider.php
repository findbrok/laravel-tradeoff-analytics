<?php

namespace FindBrok\TradeoffAnalytics;

use FindBrok\WatsonBridge\Bridge;
use Illuminate\Support\ServiceProvider;
use FindBrok\TradeoffAnalytics\Support\DataCollection;
use FindBrok\TradeoffAnalytics\Contracts\TradeoffAnalyticsInterface;

class TradeoffAnalyticsServiceProvider extends ServiceProvider
{
    /**
     * Interfaces and their concrete classes.
     *
     * @var array
     */
    protected $binds = [
        TradeoffAnalyticsInterface::class => Engine::class,
    ];

    /**
     * Defines all data collectors class aliases.
     *
     * @var array
     */
    protected $dataCollectors = [
        'TradeoffProblem'                       => DataCollection\Problem::class,
        'TradeoffProblemColumn'                 => DataCollection\ProblemColumn::class,
        'TradeoffProblemOption'                 => DataCollection\ProblemOption::class,
        'TradeoffProblemColumnCategoricalRange' => DataCollection\ProblemColumnCategoricalRange::class,
        'TradeoffProblemColumnDateRange'        => DataCollection\ProblemColumnDateRange::class,
        'TradeoffProblemColumnValueRange'       => DataCollection\ProblemColumnValueRange::class,
        'TradeoffDilemma'                       => DataCollection\Dilemma::class,
        'TradeoffResolution'                    => DataCollection\Resolution::class,
        'TradeoffSolution'                      => DataCollection\Solution::class,
        'TradeoffSolutionStatusCause'           => DataCollection\SolutionStatusCause::class,
        'TradeoffMap'                           => DataCollection\Map::class,
        'TradeoffMapAnchor'                     => DataCollection\MapAnchor::class,
        'TradeoffMapNode'                       => DataCollection\MapNode::class,
        'TradeoffMapNodeCoordinates'            => DataCollection\MapNodeCoordinates::class,
    ];

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

        // Register bindings.
        $this->registerBindings();
        // Register Bridge.
        $this->registerWatsonBridge();
        // Register Data Collectors.
        $this->registerDataCollections();
    }

    /**
     * Register bindings.
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
     * Register Watson Bridge.
     *
     * @return void
     */
    public function registerWatsonBridge()
    {
        // Register Bridge.
        $this->app->bind('TradeoffAnalyticsBridge', function ($app, $args = []) {
            return new Bridge($args['username'], $args['password'], $args['url']);
        });
    }

    /**
     * Register all data Collectors.
     *
     * @return void
     */
    public function registerDataCollections()
    {
        // Bind Each Collector.
        collect($this->dataCollectors)->each(function ($className, $aliasName) {
            $this->app->bind($aliasName, function ($app, $items = []) use ($className) {
                return new $className($items);
            });
        });
    }
}
