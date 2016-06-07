<?php

namespace FindBrok\TradeoffAnalytics;

use FindBrok\TradeoffAnalytics\Contracts\TradeoffAnalyticsInterface;
use FindBrok\TradeoffAnalytics\Support\DataCollection\Problem;

/**
 * Class Engine.
 */
class Engine extends AbstractEngine implements TradeoffAnalyticsInterface
{
    /**
     * Resolve the problem dilemma.
     *
     * @param \FindBrok\TradeoffAnalytics\Support\DataCollection\Problem $problem
     * @param bool                                                       $generateVisualization
     *
     * @throws \FindBrok\WatsonBridge\Exceptions\WatsonBridgeException
     *
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\Dilemma
     */
    public function getDilemma(Problem $problem, $generateVisualization = true)
    {
        //Get Response from Watson
        $response = $this->makeBridge()->post(
            'v1/dilemmas?generate_visualization='.var_export($generateVisualization, true),
            $problem->statement()
        );
        //Get Response content
        return make_tradeoff_dilemma(json_decode($response->getBody()->getContents(), true));
    }
}
