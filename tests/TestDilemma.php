<?php

use FindBrok\TradeoffAnalytics\Support\DataCollection\Dilemma;
use Orchestra\Testbench\TestCase;

/**
 * Class TestDilemma
 */
class TestDilemma extends TestCase
{
    /**
     * Setup test
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Tear down test
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return ['FindBrok\TradeoffAnalytics\TradeoffAnalyticsServiceProvider'];
    }

    /**
     * Test that we can create the Dilemma Object
     *
     * @return void
     */
    public function testDilemmaCanBeConstructed()
    {
        $dilemma = $this->app->make('TradeoffAnalyticsDilemma', ['foo' => 'bar']);
        $this->assertInstanceOf(Dilemma::class, $dilemma);
    }
}
