<?php

use Orchestra\Testbench\TestCase;
use FindBrok\TradeoffAnalytics\Support\DataCollection;

class TestSolution extends TestCase
{
    /**
     * Dilemma Object.
     *
     * @var \FindBrok\TradeoffAnalytics\Support\DataCollection\Dilemma
     */
    protected $dilemma;

    /**
     * The Resolution object.
     *
     * @var \FindBrok\TradeoffAnalytics\Support\DataCollection\Resolution
     */
    protected $resolution;

    /**
     * Setup test.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->dilemma = $this->app->make('TradeoffDilemma', $this->getResolution());
        $this->resolution = $this->dilemma->getResolution();
    }

    /**
     * Tear down test.
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        unset($this->dilemma);
        unset($this->resolution);
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
        return ['FindBrok\TradeoffAnalytics\TradeoffAnalyticsServiceProvider'];
    }

    /**
     * Get Resolution array.
     *
     * @return string
     */
    public function getResolution()
    {
        return json_decode(file_get_contents(__DIR__.'/fixtures/resolution.json'), true);
    }

    /**
     * Get an Incomplete solution.
     *
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\Solution
     */
    public function getAnInCompleteSolution()
    {
        return collect($this->resolution->getIncompleteSolutions(true))->random(1);
    }

    /**
     * Test that the hasStatusCause method on the Solution object works as Expected.
     *
     * @return void
     */
    public function testHasStatusCauseMethodOnSolutionObject()
    {
        $this->assertTrue($this->getAnInCompleteSolution()->hasStatusCause());
    }

    /**
     * Test that the getStatusCause will return an StatusCause object.
     *
     * @return void
     */
    public function testGetStatusCauseMethod()
    {
        $solution = $this->getAnInCompleteSolution();
        $this->assertInstanceOf(DataCollection\SolutionStatusCause::class, $solution->getStatusCause());
    }
}
