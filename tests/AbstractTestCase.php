<?php

namespace FindBrok\TradeoffAnalytics\Tests;

use \Mockery as m;
use GuzzleHttp\Psr7\Response;
use FindBrok\WatsonBridge\Bridge;
use Orchestra\Testbench\TestCase;
use FindBrok\WatsonBridge\WatsonBridgeServiceProvider;
use FindBrok\TradeoffAnalytics\TradeoffAnalyticsServiceProvider;

abstract class AbstractTestCase extends TestCase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    protected function tearDown()
    {
        m::close();
        parent::tearDown();
    }

    /**
     * Get package providers.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            WatsonBridgeServiceProvider::class,
            TradeoffAnalyticsServiceProvider::class,
        ];
    }

    /**
     * Get the problem fixture.
     *
     * @return string
     */
    public function getProblem()
    {
        return file_get_contents(__DIR__.'/fixtures/problem.json');
    }

    /**
     * Get Resolution Json Body Response.
     *
     * @return string
     */
    public function getResolution()
    {
        return file_get_contents(__DIR__.'/fixtures/resolution.json');
    }

    /**
     * Return a mocked WatsonAPI bridge with
     * resolution response.
     *
     * @return mixed
     */
    public function mockWatsonBridge()
    {
        // Mock WatsonBridge Response
        $mockedBridge = m::mock(Bridge::class);
        $mockedBridge->shouldReceive('post')
                     ->withAnyArgs()
                     ->andReturn(new Response(200, [], $this->getResolution()));

        return $mockedBridge;
    }
}
