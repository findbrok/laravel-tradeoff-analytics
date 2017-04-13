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
                "name"     => "price",
                "position" => [
                    "x" => 0,
                    "y" => 0,
                ],
            ],
        ]);
        $this->assertTrue($map->hasAnchors());
    }

    /**
     * Get an Anchor point.
     *
     * @return DataCollection\MapAnchor
     */
    /*public function getAnchor()
    {
        return collect($this->map->getAnchors())->random();
    }*/

    /**
     * Get a Node point.
     *
     * @return DataCollection\MapNode
     */
    /*public function getNode()
    {
        return collect($this->map->getNodes())->random();
    }*/

    /**
     * Test the getAnchors method on the Map object.
     *
     * @return void
     */
    /*public function testMapGetAnchorsMethod()
    {
        $anchors = $this->map->getAnchors();
        $this->assertCount(3, $anchors);
        foreach ($anchors as $anchor) {
            $this->assertInstanceOf(DataCollection\MapAnchor::class, $anchor);
        }
    }*/

    /**
     * Test the getNodes method on the Map object.
     *
     * @return void
     */
    /*public function testMapGetNodesMethod()
    {
        $nodes = $this->map->getNodes();
        $this->assertCount(4, $nodes);
        foreach ($nodes as $node) {
            $this->assertInstanceOf(DataCollection\MapNode::class, $node);
        }
    }*/

    /**
     * Test that the getCoordinates method on the MapAnchor object works.
     *
     * @return void
     */
    /*public function testMapAnchorGetCoordinatesMethod()
    {
        $coordinates = $this->getAnchor()->getCoordinates();
        $this->assertInstanceOf(DataCollection\MapNodeCoordinates::class, $coordinates);
    }*/

    /**
     * Test that the getCoordinates method on the MapNode object works.
     *
     * @return void
     */
    /*public function testMapNodeGetCoordinatesMethod()
    {
        $coordinates = $this->getAnchor()->getCoordinates();
        $this->assertInstanceOf(DataCollection\MapNodeCoordinates::class, $coordinates);
    }*/
}
