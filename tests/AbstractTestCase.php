<?php

namespace FindBrok\TradeoffAnalytics\Tests;

use Orchestra\Testbench\TestCase;
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
        return [TradeoffAnalyticsServiceProvider::class];
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
}
