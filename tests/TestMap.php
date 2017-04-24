<?php

namespace FindBrok\TradeoffAnalytics\Tests;

use FindBrok\TradeoffAnalytics\Models\Resolution\Map\Map;

class TestMap extends AbstractTestCase
{
    /**
     * Test that the hasAnchors method
     * works as expected on the Map
     * method.
     *
     * @return void
     */
    public function testHasAnchorsMethod()
    {
        $map = $this->app->make(Map::class);

        $this->assertFalse($map->hasAnchors());
        $map->setData([
            'anchors' => [
                'name'     => 'price',
                'position' => [
                    'x' => 0,
                    'y' => 0,
                ],
            ],
        ]);
        $this->assertTrue($map->hasAnchors());
    }
}
