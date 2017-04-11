<?php

namespace FindBrok\TradeoffAnalytics\Concerns;

use FindBrok\WatsonBridge\Bridge;

trait Bridgeable
{
    /**
     * Watson API Bridge instance.
     *
     * @var Bridge
     */
    protected $bridge;

    public function getBridge()
    {
    }
}
