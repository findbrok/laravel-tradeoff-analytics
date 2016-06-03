<?php

namespace FindBrok\TradeoffAnalytics;

use FindBrok\TradeoffAnalytics\Contracts\TradeoffAnalyticsInterface;

/**
 * Class Engine
 *
 * @package FindBrok\TradeoffAnalytics
 */
class Engine extends AbstractEngine implements TradeoffAnalyticsInterface
{
    /**
     * Resolve the problem dilemma
     *
     * @param \FindBrok\TradeoffAnalytics\Support\DataCollection\Problem $problem
     * @throws \FindBrok\WatsonBridge\Exceptions\WatsonBridgeException
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\Dilemma
     */
    public function getDilemma($problem)
    {
        //Get Response from Watson
        $response = $this->makeBridge()->post('v1/dilemmas?generate_visualization=true', $problem->statement());
        //Get Response content
        return make_tradeoff_dilemma(json_decode($response->getBody()->getContents(), true));
    }
}
