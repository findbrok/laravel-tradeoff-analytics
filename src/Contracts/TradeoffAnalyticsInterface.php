<?php

namespace FindBrok\TradeoffAnalytics\Contracts;

use FindBrok\TradeoffAnalytics\Support\DataCollection\Problem;

interface TradeoffAnalyticsInterface
{
    /**
     * Resolve the problem dilemma.
     *
     * @param Problem $problem
     * @param bool    $generateVisualization
     *
     * @throws \FindBrok\WatsonBridge\Exceptions\WatsonBridgeException
     *
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\Dilemma
     */
    public function getDilemma(Problem $problem, $generateVisualization = true);
}
