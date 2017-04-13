<?php

namespace FindBrok\TradeoffAnalytics\Tests;

use FindBrok\TradeoffAnalytics\Models\Resolution\Solution;

class TestSolution extends AbstractTestCase
{
    /**
     * Test that isFavoured method works as
     * expected on the Solution model.
     *
     * @return void
     */
    public function testIsFavouredMethod()
    {
        $solutionF = $this->app->make(Solution::class);

        $solutionF->setData([
            "solution_ref" => "9",
            "status"       => "FRONT",
        ]);
        $this->assertTrue($solutionF->isFavoured());

        $solutionNF = $this->app->make(Solution::class);
        $solutionNF->setData([
            "solution_ref" => "9",
            "status"       => "EXCLUDED",
        ]);
        $this->assertFalse($solutionNF->isFavoured());
    }

    /**
     * Get an Incomplete solution.
     *
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\Solution
     */
    /*public function getAnInCompleteSolution()
    {
        return collect($this->resolution->getIncompleteSolutions(true))->random(1);
    }*/

    /**
     * Test that the hasStatusCause method on the Solution object works as Expected.
     *
     * @return void
     */
    /*public function testHasStatusCauseMethodOnSolutionObject()
    {
        $this->assertTrue($this->getAnInCompleteSolution()->hasStatusCause());
    }*/

    /**
     * Test that the getStatusCause will return an StatusCause object.
     *
     * @return void
     */
    /*public function testGetStatusCauseMethod()
    {
        $solution = $this->getAnInCompleteSolution();
        $this->assertInstanceOf(DataCollection\SolutionStatusCause::class, $solution->getStatusCause());
    }*/
}
