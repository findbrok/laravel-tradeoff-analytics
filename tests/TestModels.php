<?php

namespace FindBrok\TradeoffAnalytics\Tests;

use Illuminate\Support\Collection;
use FindBrok\TradeoffAnalytics\Models\Dilemma;
use FindBrok\TradeoffAnalytics\Models\Problem\Column;
use FindBrok\TradeoffAnalytics\Models\Problem\Option;
use FindBrok\TradeoffAnalytics\Models\Problem\Problem;
use FindBrok\TradeoffAnalytics\Models\Resolution\Map\Map;
use FindBrok\TradeoffAnalytics\Models\Resolution\Map\Anchor;
use FindBrok\TradeoffAnalytics\Models\Resolution\Resolution;
use FindBrok\TradeoffAnalytics\Models\Problem\Range\DateRange;
use FindBrok\TradeoffAnalytics\Models\Problem\Range\ValueRange;
use FindBrok\TradeoffAnalytics\Models\Problem\Range\CategoricalRange;
use FindBrok\TradeoffAnalytics\Models\Resolution\PreferableSolutions;
use FindBrok\TradeoffAnalytics\Models\Resolution\Map\MapNodeCoordinates;

class TestModels extends AbstractTestCase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Test that we are able to create CategoricalRange
     * model.
     *
     * @return void
     */
    public function testCreateCategoricalRangeModel()
    {
        $categoricalRange = $this->app->make(CategoricalRange::class)
                                      ->setData(['range' => ['Apple', 'HTC', 'Samsung', 'Sony']]);

        $this->assertInstanceOf(CategoricalRange::class, $categoricalRange);
        $this->assertEquals(['Apple', 'HTC', 'Samsung', 'Sony'], $categoricalRange->range);
    }

    /**
     * Test that we are able to create DateRange
     * model.
     *
     * @return void
     */
    public function testCreateDateRangeModel()
    {
        $dateRange = $this->app->make(DateRange::class)
                               ->setData([
                                   'low'  => '2017-03-01T00:00:00Z',
                                   'high' => '2018-03-01T00:00:00Z',
                               ]);

        $this->assertInstanceOf(DateRange::class, $dateRange);
        $this->assertEquals('2017-03-01T00:00:00Z', $dateRange->low);
        $this->assertEquals('2018-03-01T00:00:00Z', $dateRange->high);
    }

    /**
     * Test that we are able to create ValueRange
     * model.
     *
     * @return void
     */
    public function testCreateValueRangeModel()
    {
        $valueRangeInt = $this->app->make(ValueRange::class)
                                   ->setData([
                                       'low'  => 0,
                                       'high' => 400,
                                   ]);

        $valueRangeFloat = $this->app->make(ValueRange::class)
                                     ->setData([
                                         'low'  => 0.3,
                                         'high' => 0.9,
                                     ]);

        $this->assertInstanceOf(ValueRange::class, $valueRangeInt);
        $this->assertInstanceOf(ValueRange::class, $valueRangeFloat);
        $this->assertEquals(0, $valueRangeInt->low);
        $this->assertEquals(400, $valueRangeInt->high);
        $this->assertEquals(0.3, $valueRangeFloat->low);
        $this->assertEquals(0.9, $valueRangeFloat->high);
    }

    /**
     * Test we are able to create the different types of
     * Column Model.
     *
     * @return void
     */
    public function testCreateTypesColumnModel()
    {
        $columnNumeric = $this->app->make(Column::class)
                                   ->setData([
                                       'type'  => 'numeric',
                                       'range' => [
                                           'low'  => 0,
                                           'high' => 400,
                                       ],
                                   ]);

        $this->assertInstanceOf(Column::class, $columnNumeric);
        $this->assertInstanceOf(ValueRange::class, $columnNumeric->range);
        $this->assertEquals(0, $columnNumeric->range->low);
        $this->assertEquals(400, $columnNumeric->range->high);

        $columnDateTime = $this->app->make(Column::class)
                                    ->setData([
                                        'type'  => 'datetime',
                                        'range' => [
                                            'low'  => '2017-03-01T00:00:00Z',
                                            'high' => '2018-03-01T00:00:00Z',
                                        ],
                                    ]);
        $this->assertInstanceOf(Column::class, $columnDateTime);
        $this->assertInstanceOf(DateRange::class, $columnDateTime->range);
        $this->assertEquals('2017-03-01T00:00:00Z', $columnDateTime->range->low);
        $this->assertEquals('2018-03-01T00:00:00Z', $columnDateTime->range->high);

        $columnCategorical = $this->app->make(Column::class)
                                       ->setData([
                                           'type'  => 'categorical',
                                           'range' => ['Apple', 'HTC', 'Samsung', 'Sony'],
                                       ]);
        $this->assertInstanceOf(Column::class, $columnCategorical);
        $this->assertInstanceOf(CategoricalRange::class, $columnCategorical->range);
        $this->assertEquals(['Apple', 'HTC', 'Samsung', 'Sony'], $columnCategorical->range->range);
    }

    /**
     * Test that we are able to create the Option
     * model.
     *
     * @return void
     */
    public function testCreateOptionModel()
    {
        $option = $this->app->make(Option::class)->setData([
            'key'      => '1',
            'name'     => 'Samsung Galaxy S4',
            'values'   => [
                'price'  => 249,
                'weight' => 130,
                'brand'  => 'Samsung',
                'rDate'  => '2013-04-29T00:00:00Z',
            ],
            'app_data' => [
                'lorem' => 'ipsum',
            ],
        ]);

        $this->assertInstanceOf(Option::class, $option);
        $this->assertInstanceOf(Collection::class, $option->values);
        $this->assertInstanceOf(Collection::class, $option->app_data);
        $this->assertEquals('1', $option->key);
        $this->assertEquals('Samsung Galaxy S4', $option->name);

        $this->assertEquals([
            'price'  => 249,
            'weight' => 130,
            'brand'  => 'Samsung',
            'rDate'  => '2013-04-29T00:00:00Z',
        ], $option->values->toArray());
        $this->assertEquals(['lorem' => 'ipsum'], $option->app_data->toArray());
    }

    /**
     * Test that we can create a Problem using a JSON
     * string.
     *
     * @return void
     */
    public function testCreateProblemModelFromAJsonString()
    {
        $problem = $this->app->make(Problem::class)
                             ->setData($this->getProblem());

        $this->assertInstanceOf(Problem::class, $problem);
        $this->assertEquals('phones', $problem->subject);
        $this->assertCount(4, $problem->columns);
        $this->assertCount(16, $problem->options);
    }

    /**
     * Test that we are able to create Anchor
     * model object.
     *
     * @return void
     */
    public function testCreateAnchorModel()
    {
        $anchor = $this->app->make(Anchor::class)->setData([
            'name'     => 'price',
            'position' => [
                'x' => 0,
                'y' => 0,
            ],
        ]);

        $this->assertInstanceOf(Anchor::class, $anchor);
        $this->assertEquals('price', $anchor->name);
        $this->assertInstanceOf(MapNodeCoordinates::class, $anchor->position);
        $this->assertEquals(0, $anchor->position->x);
        $this->assertEquals(0, $anchor->position->y);
    }

    /**
     * Test that the Dilemma model can be constructed.
     *
     * @return void
     */
    public function testCreateDilemmaModelFromAJsonString()
    {
        $dilemma = $this->app->make(Dilemma::class)
                             ->setData($this->getResolution());

        $this->assertInstanceOf(Dilemma::class, $dilemma);
        $this->assertInstanceOf(Resolution::class, $dilemma->resolution);
        $this->assertCount(16, $dilemma->resolution->solutions);

        $this->assertInstanceOf(PreferableSolutions::class, $dilemma->resolution->preferable_solutions);

        $this->assertInstanceOf(Map::class, $dilemma->resolution->map);
        $this->assertCount(4, $dilemma->resolution->map->nodes);
        $this->assertCount(3, $dilemma->resolution->map->anchors);
    }
}
