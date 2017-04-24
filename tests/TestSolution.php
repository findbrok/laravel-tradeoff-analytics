<?php

namespace FindBrok\TradeoffAnalytics\Tests;

use FindBrok\TradeoffAnalytics\Models\Resolution\Solution;

class TestSolution extends AbstractTestCase
{
    /**
     * Test that is method works as
     * expected on the Solution model.
     *
     * @return void
     */
    public function testIsMethod()
    {
        $solutionF = $this->app->make(Solution::class);

        $solutionF->setData([
            'solution_ref' => '9',
            'status'       => 'FRONT',
        ]);
        $this->assertFalse($solutionF->is('EXCLUDED'));
        $this->assertTrue($solutionF->is('FRONT'));

        $solutionNF = $this->app->make(Solution::class);
        $solutionNF->setData([
            'solution_ref' => '9',
            'status'       => 'EXCLUDED',
        ]);
        $this->assertFalse($solutionNF->is('FRONT'));
        $this->assertTrue($solutionNF->is('EXCLUDED'));
    }

    /**
     * Test the hasStatusCause method works as
     * expected.
     *
     * @return void
     */
    public function testHasStatusCauseMethod()
    {
        $solution = $this->app->make(Solution::class);

        $this->assertFalse($solution->hasStatusCause());

        $solution->setData([
            'solution_ref' => '2',
            'status'       => 'INCOMPLETE',
            'status_cause' => [
                'message'    => 'A column of a option is out of range. Option "2" has a value in column "price" which is:"449" while the column range" is: [0.0,400.0]',
                'error_code' => 'RANGE_MISMATCH',
                'tokens'     => [
                    'price',
                    '449',
                    '[0.0,400.0]',
                ],
            ],
        ]);
        $this->assertTrue($solution->hasStatusCause());
    }

    /**
     * Test that the isShadowedByOthers method
     * works as expected.
     *
     * @return void
     */
    public function testIsShadowedByOthersMethod()
    {
        $solution = $this->app->make(Solution::class);

        $this->assertFalse($solution->isShadowedByOthers());

        $solution->setData([
            'solution_ref' => '7',
            'status'       => 'FRONT',
            'shadow_me'    => [
                '14',
            ],
        ]);

        $this->assertTrue($solution->isShadowedByOthers());
    }

    /**
     * Test that the shadowsOthers method
     * works as expected.
     *
     * @return void
     */
    public function testShadowsOthersMethod()
    {
        $solution = $this->app->make(Solution::class);

        $this->assertFalse($solution->shadowsOthers());

        $solution->setData([
            'solution_ref' => '14',
            'status'       => 'FRONT',
            'shadows'      => [
                '7',
            ],
        ]);

        $this->assertTrue($solution->shadowsOthers());
    }
}
