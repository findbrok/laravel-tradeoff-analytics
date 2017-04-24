<?php

namespace FindBrok\TradeoffAnalytics\Tests;

use Illuminate\Support\Collection;
use FindBrok\TradeoffAnalytics\Models\Resolution\Solution;
use FindBrok\TradeoffAnalytics\Models\Resolution\Resolution;

class TestResolution extends AbstractTestCase
{
    /**
     * Test that the hasSolutions method
     * works on the Resolution object.
     *
     * @return void
     */
    public function testHasSolutionsMethod()
    {
        $resolution = $this->app->make(Resolution::class);

        $this->assertFalse($resolution->hasSolutions());
        $resolution->setData([
            'solutions' => [
                [
                    'solution_ref' => '14',
                    'status'       => 'FRONT',
                    'shadows'      => ['7'],
                ],
            ],
        ]);
        $this->assertTrue($resolution->hasSolutions());
    }

    /**
     * Test that the hasMap method works as expected.
     *
     * @return void
     */
    public function testHasMapMethod()
    {
        $resolution = $this->app->make(Resolution::class);

        $this->assertFalse($resolution->hasMap());
        $resolution->setData([
            'map' => [
                'nodes' => [
                    [
                        'coordinates'   => [
                            'x' => 0,
                            'y' => 0,
                        ],
                        'solution_refs' => [
                            '9',
                        ],
                    ],
                    [
                        'coordinates'   => [
                            'x' => 8,
                            'y' => 1.7320508,
                        ],
                        'solution_refs' => [
                            '1',
                        ],
                    ],
                ],
            ],
        ]);
        $this->assertTrue($resolution->hasMap());
    }

    /**
     * Test that the find findSolution method
     * on the Resolution object works as expected.
     *
     * @return void
     */
    public function testFindSolutionMethod()
    {
        $resolution = $this->app->make(Resolution::class);
        $resolution->setData([
            'solutions' => [
                [
                    'solution_ref' => '14',
                    'status'       => 'FRONT',
                    'shadows'      => ['7'],
                ],
                [
                    'solution_ref' => '15',
                    'status'       => 'FRONT',
                ],
                [
                    'solution_ref' => '16',
                    'status'       => 'EXCLUDED',
                ],
            ],
        ]);

        $solution = $resolution->findSolution('14');
        $this->assertInstanceOf(Solution::class, $solution);
        $this->assertEquals('14', $solution->solution_ref);
        $this->assertEquals('FRONT', $solution->status);

        $solution2 = $resolution->findSolution(16);
        $this->assertInstanceOf(Solution::class, $solution2);
        $this->assertEquals('16', $solution2->solution_ref);
        $this->assertEquals('EXCLUDED', $solution2->status);
    }

    /**
     * Test that the findSolutionsShadowing method
     * works as expected.
     *
     * @return void
     */
    public function testFindSolutionsShadowingMethod()
    {
        $resolution = $this->app->make(Resolution::class);
        $resolution->setData([
            'solutions' => [
                [
                    'solution_ref' => '14',
                    'status'       => 'FRONT',
                    'shadows'      => ['7'],
                ],
                [
                    'solution_ref' => '15',
                    'status'       => 'FRONT',
                ],
                [
                    'solution_ref' => '7',
                    'status'       => 'FRONT',
                    'shadow_me'    => [
                        '14',
                        '15',
                    ],
                ],
            ],
        ]);

        $solutions = $resolution->findSolutionsShadowing('7');
        $this->assertInstanceOf(Collection::class, $solutions);
        $this->assertCount(2, $solutions);
        $this->assertEquals('14', $solutions[0]->solution_ref);
        $this->assertEquals('15', $solutions[1]->solution_ref);
    }

    /**
     * Test that the findSolutionsBeingShadowedBy method
     * works as expected.
     *
     * @return void
     */
    public function testFindSolutionsBeingShadowedByMethod()
    {
        $resolution = $this->app->make(Resolution::class);
        $resolution->setData([
            'solutions' => [
                [
                    'solution_ref' => '14',
                    'status'       => 'FRONT',
                    'shadows'      => ['7', '15'],
                ],
                [
                    'solution_ref' => '15',
                    'status'       => 'FRONT',
                ],
                [
                    'solution_ref' => '7',
                    'status'       => 'FRONT',
                    'shadow_me'    => [
                        '14',
                        '15',
                    ],
                ],
            ],
        ]);

        $solutions = $resolution->findSolutionsBeingShadowedBy('14');
        $this->assertInstanceOf(Collection::class, $solutions);
        $this->assertCount(2, $solutions);
        $this->assertEquals('7', $solutions[0]->solution_ref);
        $this->assertEquals('15', $solutions[1]->solution_ref);
    }

    /**
     * Test that the getSolutionsByStatus method works
     * as expected.
     *
     * @return void
     */
    public function testGetSolutionsByStatusMethod()
    {
        $resolution = $this->app->make(Resolution::class);
        $resolution->setData([
            'solutions' => [
                [
                    'solution_ref' => '14',
                    'status'       => 'FRONT',
                ],
                [
                    'solution_ref' => '15',
                    'status'       => 'FRONT',
                ],
                [
                    'solution_ref' => '16',
                    'status'       => 'EXCLUDED',
                ],
                [
                    'solution_ref' => '17',
                    'status'       => 'EXCLUDED',
                ],
            ],
        ]);

        $solutions = $resolution->getSolutionsByStatus('front');
        $this->assertInstanceOf(Collection::class, $solutions);
        $this->assertCount(2, $solutions);
        $this->assertEquals('14', $solutions[0]->solution_ref);
        $this->assertEquals('15', $solutions[1]->solution_ref);
    }
}
