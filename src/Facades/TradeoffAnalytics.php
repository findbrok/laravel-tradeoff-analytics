<?php

namespace FindBrok\TradeoffAnalytics\Facades;

use Illuminate\Support\Facades\Facade;

class TradeoffAnalytics extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'TradeoffAnalytics';
    }
}
