<?php

namespace FindBrok\TradeoffAnalytics\Concerns;

use FindBrok\WatsonBridge\Bridge;
use FindBrok\WatsonBridge\Support\Carpenter;
use FindBrok\TradeoffAnalytics\Exceptions\UndefinedBridgeException;

trait Bridgeable
{
    /**
     * Watson API Bridge instance.
     *
     * @var Bridge
     */
    protected $bridge;

    /**
     * Explicitly specify a bridge to use for
     * subsequent request to the Watson API.
     *
     * @param string $bridgeName
     *
     * @return $this
     */
    public function useBridge($bridgeName)
    {
        // Construct Bridge.
        $this->bridge = $this->makeBridge($bridgeName);

        return $this;
    }

    /**
     * Gets the Bridge used for making requests.
     *
     * @return Bridge
     */
    public function getBridge()
    {
        // Bridge is already built.
        if ($this->hasBridge()) {
            return $this->bridge;
        }

        return app('TradeoffAnalytics');
    }

    /**
     * Sets Bridge to the class.
     *
     * @param Bridge $bridge
     *
     * @return $this
     */
    public function setBridge(Bridge $bridge)
    {
        $this->bridge = $bridge;

        return $this;
    }

    /**
     * Checks if Bridge is already present.
     *
     * @return bool
     */
    public function hasBridge()
    {
        return ! is_null($this->bridge) && $this->bridge instanceof Bridge;
    }

    /**
     * Construct a new Watson API Bridge.
     *
     * @param string $bridgeName
     *
     * @return Bridge
     */
    protected function makeBridge($bridgeName)
    {
        /** @var Carpenter $carpenter */
        $carpenter = app(Carpenter::class);

        // Bridge name not found.
        if (! array_key_exists($bridgeName, config('tradeoff-analytics.bridges'))) {
            throw new UndefinedBridgeException;
        }

        // Get Bridge Definition.
        $bridgeDefinition = config('tradeoff-analytics.bridges.'.$bridgeName);

        // Return new Bridge
        return $carpenter->constructBridge(
            $bridgeDefinition['credential_name'], $bridgeDefinition['service'], $bridgeDefinition['auth_method']
        );
    }
}
