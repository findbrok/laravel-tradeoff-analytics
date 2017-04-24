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

    /*
     * Test that we get only the favoured solutions from our Resolution.
     *
     * @return void
     */
    /*public function testResolutionGetFavouredSolutions()
    {
        $favouredSolutions = $this->dilemma->getResolution()->getFavouredSolutions(true);
        $this->assertCount(4, $favouredSolutions);
        foreach ($favouredSolutions as $solution) {
            $this->assertInstanceOf(DataCollection\Solution::class, $solution);
        }
    }*/

    /*
     * Test that we can get excluded solutions from our Resolution.
     *
     * @return void
     */
    /*public function testResolutionGetExcludedSolutions()
    {
        $excludedSolutions = $this->dilemma->getResolution()->getExcludedSolutions(true);
        $this->assertCount(11, $excludedSolutions);
        foreach ($excludedSolutions as $solution) {
            $this->assertInstanceOf(DataCollection\Solution::class, $solution);
        }
    }*/

    /*
     * Test that we can get Incomplete solutions from our Resolution.
     *
     * @return void
     */
    /*public function testResolutionGetIncompleteSolutions()
    {
        $incompleteSolutions = $this->dilemma->getResolution()->getIncompleteSolutions(true);
        $this->assertCount(1, $incompleteSolutions);
        foreach ($incompleteSolutions as $solution) {
            $this->assertInstanceOf(DataCollection\Solution::class, $solution);
        }
    }*/

    /*
     * Test that we can get solutions that do not meet preference from our Resolution.
     *
     * @return void
     */
    /*public function testResolutionGetUnmetCategoricalPreferenceSolutions()
    {
        $unmetPreferenceSolutions = $this->dilemma->getResolution()->getUnmetCategoricalPreferenceSolutions(true);
        $this->assertCount(0, $unmetPreferenceSolutions);
    }*/

    /*
     * Test that the hasMap method on the Resolution works.
     *
     * @return void
     */
    /* public function testResolutionHasMapMethod()
     {
         $this->assertTrue($this->dilemma->getResolution()->hasMap());
     }*/

    /*
     * Test that we can get the Map object from the Resolution.
     *
     * @return void
     */
    /*public function testResolutionGetMapMethod()
    {
        $this->assertInstanceOf(DataCollection\Map::class, $this->dilemma->getResolution()->getMap());
    }*/

    /*
     * Test that we are able to find a particular solution in the Resolution object.
     *
     * @return void
     */
    /*public function testResolutionFindSolutionMethod()
    {
        $solution = $this->dilemma->getResolution()->findSolution('14');
        $this->assertInstanceOf(DataCollection\Solution::class, $solution);
        $this->assertEquals('14', $solution->get('solution_ref'));
        $this->assertTrue($solution->isFavoured());
    }*/

    /*
     * Test that we are able to retrieve all solutions that
     * shadow a particular solution.
     *
     * @return void
     */
    /*public function testResolutionGetSolutionsShadowingMethod()
    {
        $solutions = $this->dilemma->getResolution()->getSolutionsShadowing('7');
        $this->assertCount(1, $solutions);
        $this->assertEquals('14', $solutions[0]->get('solution_ref'));
    }*/

    /*
     * Test that we can get all the solutions being shadowed by a particular solution.
     *
     * @return void
     */
    /*public function testResolutionGetSolutionsBeingShadowedByMethod()
    {
        $solutions = $this->dilemma->getResolution()->getSolutionsBeingShadowedBy('14');
        $this->assertCount(1, $solutions);
        $this->assertEquals('7', $solutions['0']->get('solution_ref'));
    }*/
}
