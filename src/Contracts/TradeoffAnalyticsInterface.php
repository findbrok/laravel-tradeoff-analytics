<?php

namespace FindBrok\TradeoffAnalytics\Contracts;

/**
 * Interface TradeoffAnalyticsInterface
 *
 * @package FindBrok\TradeoffAnalytics\Contracts
 */
interface TradeoffAnalyticsInterface
{
    /**
     * Resolve the problem dilemma
     *
     * @param \FindBrok\TradeoffAnalytics\Support\DataCollection\Problem $problem
     * @return mixed
     */
    public function getDilemma($problem);
}
