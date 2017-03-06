<?php

use Orchestra\Testbench\TestCase;
use FindBrok\TradeoffAnalytics\Support\DataCollection;

class TestMap extends TestCase
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
     * The Map Object.
     *
     * @var \FindBrok\TradeoffAnalytics\Support\DataCollection\Map
     */
    protected $map;

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
        $this->map = $this->resolution->getMap();
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
        unset($this->map);
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
     * Get an Anchor point.
     *
     * @return DataCollection\MapAnchor
     */
    public function getAnchor()
    {
        return collect($this->map->getAnchors())->random();
    }

    /**
     * Get a Node point.
     *
     * @return DataCollection\MapNode
     */
    public function getNode()
    {
        return collect($this->map->getNodes())->random();
    }

    /**
     * Test the getAnchors method on the Map object.
     *
     * @return void
     */
    public function testMapGetAnchorsMethod()
    {
        $anchors = $this->map->getAnchors();
        $this->assertCount(3, $anchors);
        foreach ($anchors as $anchor) {
            $this->assertInstanceOf(DataCollection\MapAnchor::class, $anchor);
        }
    }

    /**
     * Test the getNodes method on the Map object.
     *
     * @return void
     */
    public function testMapGetNodesMethod()
    {
        $nodes = $this->map->getNodes();
        $this->assertCount(4, $nodes);
        foreach ($nodes as $node) {
            $this->assertInstanceOf(DataCollection\MapNode::class, $node);
        }
    }

    /**
     * Test that the getCoordinates method on the MapAnchor object works.
     *
     * @return void
     */
    public function testMapAnchorGetCoordinatesMethod()
    {
        $coordinates = $this->getAnchor()->getCoordinates();
        $this->assertInstanceOf(DataCollection\MapNodeCoordinates::class, $coordinates);
    }

    /**
     * Test that the getCoordinates method on the MapNode object works.
     *
     * @return void
     */
    public function testMapNodeGetCoordinatesMethod()
    {
        $coordinates = $this->getAnchor()->getCoordinates();
        $this->assertInstanceOf(DataCollection\MapNodeCoordinates::class, $coordinates);
    }
}
