<?php

namespace FindBrok\TradeoffAnalytics;

use FindBrok\TradeoffAnalytics\Support\DataCollection\Problem;
use FindBrok\TradeoffAnalytics\Contracts\TradeoffAnalyticsInterface;

class Engine extends AbstractEngine implements TradeoffAnalyticsInterface
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
    public function getDilemma(Problem $problem, $generateVisualization = true)
    {
        // Get Response from Watson.
        $response = $this->makeBridge()->post('v1/dilemmas?generate_visualization='.var_export($generateVisualization,
                true), $problem->statement());

        // Get Response content.
        return make_tradeoff_dilemma(json_decode($response->getBody()->getContents(), true));
    }
}
