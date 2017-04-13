<?php

namespace FindBrok\TradeoffAnalytics\Tests;

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
                    "solution_ref" => "14",
                    "status"       => "FRONT",
                    "shadows"      => ["7"],
                ],
            ],
        ]);
        $this->assertTrue($resolution->hasSolutions());
    }
}
