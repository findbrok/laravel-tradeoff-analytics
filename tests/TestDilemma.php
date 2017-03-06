<?php

use Orchestra\Testbench\TestCase;
use FindBrok\TradeoffAnalytics\Support\DataCollection;

class TestDilemma extends TestCase
{
    /**
     * The Dilemma Object.
     *
     * @var DataCollection\Dilemma
     */
    protected $dilemma;

    /**
     * Setup test.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->dilemma = $this->app->make('TradeoffDilemma', $this->getResolution());
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
     * Test that we can create the Dilemma Object.
     *
     * @return void
     */
    public function testDilemmaCanBeConstructed()
    {
        $this->assertInstanceOf(DataCollection\Dilemma::class, $this->dilemma);
    }

    /**
     * Test that the has Problem method works.
     *
     * @return void
     */
    public function testHasProblemMethod()
    {
        $this->assertTrue($this->dilemma->hasProblem());
    }

    /**
     * Test to see if the getProblem method works.
     *
     * @return void
     */
    public function testGetProblemMethod()
    {
        $problem = $this->dilemma->getProblem();
        $this->assertInstanceOf(DataCollection\Problem::class, $problem);

        foreach ($problem->get('columns') as $problemColumn) {
            $this->assertInstanceOf(DataCollection\ProblemColumn::class, $problemColumn);
        }

        foreach ($problem->get('options') as $problemOption) {
            $this->assertInstanceOf(DataCollection\ProblemOption::class, $problemOption);
        }
    }

    /**
     * Test that the hasResolution method on the Dilemma object works.
     *
     * @return void
     */
    public function testHasResolutionMethod()
    {
        $this->assertTrue($this->dilemma->hasResolution());
    }

    /**
     * Test that we can get ResolutionObject from Dilemma.
     *
     * @return void
     */
    public function testGetResolutionFromDilemma()
    {
        $this->assertInstanceOf(DataCollection\Resolution::class, $this->dilemma->getResolution());
    }

    /**
     * Test the hasSolution method on the Resolution object.
     *
     * @return void
     */
    public function testResolutionHasSolutions()
    {
        $this->assertTrue($this->dilemma->getResolution()->hasSolutions());
    }

    /**
     * Test we can get a solution object from the Resolution.
     *
     * @return void
     */
    public function testResolutionGetAllSolutions()
    {
        foreach ($this->dilemma->getResolution()->getAllSolutions(true) as $solution) {
            $this->assertInstanceOf(DataCollection\Solution::class, $solution);
        }
    }

    /**
     * Test that we get only the favoured solutions from our Resolution.
     *
     * @return void
     */
    public function testResolutionGetFavouredSolutions()
    {
        $favouredSolutions = $this->dilemma->getResolution()->getFavouredSolutions(true);
        $this->assertCount(4, $favouredSolutions);
        foreach ($favouredSolutions as $solution) {
            $this->assertInstanceOf(DataCollection\Solution::class, $solution);
        }
    }

    /**
     * Test that we can get excluded solutions from our Resolution.
     *
     * @return void
     */
    public function testResolutionGetExcludedSolutions()
    {
        $excludedSolutions = $this->dilemma->getResolution()->getExcludedSolutions(true);
        $this->assertCount(11, $excludedSolutions);
        foreach ($excludedSolutions as $solution) {
            $this->assertInstanceOf(DataCollection\Solution::class, $solution);
        }
    }

    /**
     * Test that we can get Incomplete solutions from our Resolution.
     *
     * @return void
     */
    public function testResolutionGetIncompleteSolutions()
    {
        $incompleteSolutions = $this->dilemma->getResolution()->getIncompleteSolutions(true);
        $this->assertCount(1, $incompleteSolutions);
        foreach ($incompleteSolutions as $solution) {
            $this->assertInstanceOf(DataCollection\Solution::class, $solution);
        }
    }

    /**
     * Test that we can get solutions that do not meet preference from our Resolution.
     *
     * @return void
     */
    public function testResolutionGetUnmetCategoricalPreferenceSolutions()
    {
        $unmetPreferenceSolutions = $this->dilemma->getResolution()->getUnmetCategoricalPreferenceSolutions(true);
        $this->assertCount(0, $unmetPreferenceSolutions);
    }

    /**
     * Test that the hasMap method on the Resolution works.
     *
     * @return void
     */
    public function testResolutionHasMapMethod()
    {
        $this->assertTrue($this->dilemma->getResolution()->hasMap());
    }

    /**
     * Test that we can get the Map object from the Resolution.
     *
     * @return void
     */
    public function testResolutionGetMapMethod()
    {
        $this->assertInstanceOf(DataCollection\Map::class, $this->dilemma->getResolution()->getMap());
    }

    /**
     * Test that we are able to find a particular solution in the Resolution object.
     *
     * @return void
     */
    public function testResolutionFindSolutionMethod()
    {
        $solution = $this->dilemma->getResolution()->findSolution('14');
        $this->assertInstanceOf(DataCollection\Solution::class, $solution);
        $this->assertEquals('14', $solution->get('solution_ref'));
        $this->assertTrue($solution->isFavoured());
    }

    /**
     * Test that we are able to retrieve all solutions that
     * shadow a particular solution.
     *
     * @return void
     */
    public function testResolutionGetSolutionsShadowingMethod()
    {
        $solutions = $this->dilemma->getResolution()->getSolutionsShadowing('7');
        $this->assertCount(1, $solutions);
        $this->assertEquals('14', $solutions[0]->get('solution_ref'));
    }

    /**
     * Test that we can get all the solutions being shadowed by a particular solution.
     *
     * @return void
     */
    public function testResolutionGetSolutionsBeingShadowedByMethod()
    {
        $solutions = $this->dilemma->getResolution()->getSolutionsBeingShadowedBy('14');
        $this->assertCount(1, $solutions);
        $this->assertEquals('7', $solutions['0']->get('solution_ref'));
    }
}
