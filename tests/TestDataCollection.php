<?php

use FindBrok\TradeoffAnalytics\Exceptions\DataCollectionUnsupportedFieldException;
use Orchestra\Testbench\TestCase;

/**
 * Class TestDataCollection
 */
class TestDataCollection extends TestCase
{
    /**
     * The Problem object
     *
     * @var \FindBrok\TradeoffAnalytics\Support\DataCollection\Problem
     */
    protected $problem;

    /**
     * The ProblemColumn object
     *
     * @var \FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemColumn
     */
    protected $problemColumn;

    /**
     * The ProblemOption object
     *
     * @var \FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemOption
     */
    protected $problemOption;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->problem = app()->make('TradeoffAnalyticsProblem');
        $this->problemColumn = app()->make('TradeoffAnalyticsProblemColumn');
        $this->problemOption = app()->make('TradeoffAnalyticsProblemOption');
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        unset($this->problem);
        unset($this->problemColumn);
        unset($this->problemOption);
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    public function getPackageProviders($app)
    {
        return ['FindBrok\TradeoffAnalytics\TradeoffAnalyticsServiceProvider'];
    }

    /**
     * Test if we can create different Problem Objects
     *
     * @return void
     */
    public function testProblemObjectCanBeConstructedAndEachIsDifferent()
    {
        $problem = app()->make('TradeoffAnalyticsProblem');
        $this->assertInstanceOf('FindBrok\TradeoffAnalytics\Support\DataCollection\Problem', $problem);
        $this->assertNotSame($this->problem, $problem);
    }


    /**
     * Test ProblemObject Accepts Supported Fields
     *
     * @return void
     */
    public function testProblemObjectAcceptsSupportedFields()
    {
        $problem = app()->make('TradeoffAnalyticsProblem', [
            'subject' => 'Foo',
            'columns' => ['x' => 'bar'],
            'options' => ['bar' => 'foo'],
            'Foo' => 'Bar'
        ]);
        $this->assertEquals([
            'subject' => 'Foo',
            'columns' => ['x' => 'bar'],
            'options' => ['bar' => 'foo']
        ], $problem->all());
    }

    /**
     * Test that if we put wrong field in the problem object we get an exception
     */
    public function testProblemObjectThrowUnsupportedExceptionWhenWrongFieldIsPut()
    {
        try {
            $this->problem->put('Foo', 'Bar');
        } catch (DataCollectionUnsupportedFieldException $e) {
            $this->assertEquals(
                'Tradeoff Analytics DataCollectionException: Unsupported field Foo in FindBrok\TradeoffAnalytics\Support\DataCollection\Problem Object',
                $e->getMessage()
            );
        }
    }

    /**
     * Test that we can create ProblemColumn object
     *
     * @return void
     */
    public function testProblemColumnObjectCanBeConstructedAndEachIsDifferent()
    {
        $problemColumn = app()->make('TradeoffAnalyticsProblemColumn');
        $this->assertInstanceOf('FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemColumn', $problemColumn);
        $this->assertNotSame($this->problemColumn, $problemColumn);
    }

    /**
     * Test that we can create ProblemOption object
     *
     * @return void
     */
    public function testProblemOptionObjectCanBeConstructedAndEachIsDifferent()
    {
        $problemOption = app()->make('TradeoffAnalyticsProblemOption');
        $this->assertInstanceOf('FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemOption', $problemOption);
        $this->assertNotSame($this->problemOption, $problemOption);
    }
}
