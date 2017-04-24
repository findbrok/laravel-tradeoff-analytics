<?php

namespace FindBrok\TradeoffAnalytics\Tests;

use FindBrok\TradeoffAnalytics\Models\Dilemma;
use FindBrok\TradeoffAnalytics\Models\Resolution\Resolution;

class TestDilemma extends AbstractTestCase
{
    /**
     * Test the loadProblem method.
     *
     * @return void
     */
    public function testLoadProblemMethod()
    {
        $dilemma = $this->app->make(Dilemma::class);

        $this->assertFalse($dilemma->hasProblem());

        $dilemma->loadProblem($this->getProblem());

        $this->assertTrue($dilemma->hasProblem());

        $this->assertEquals('phones', $dilemma->problem->subject);
        $this->assertCount(4, $dilemma->problem->columns);
        $this->assertCount(16, $dilemma->problem->options);
    }

    /**
     * Test that we can get ResolutionObject from Dilemma.
     *
     * @return void
     */
    public function testGetResolutionFromDilemma()
    {
        $this->app->instance('TradeoffAnalytics', $this->mockWatsonBridge());

        $dilemma = $this->app->make(Dilemma::class)
                             ->loadProblem($this->getProblem());

        $this->assertFalse($dilemma->hasResolution());
        $dilemma->resolve();
        $this->assertTrue($dilemma->hasResolution());
        $this->assertInstanceOf(Resolution::class, $dilemma->resolution);
    }
}
