<?php

use Carbon\Carbon;
use Faker\Factory;
use FindBrok\TradeoffAnalytics\Exceptions\DataCollectionUnsupportedFieldException;
use FindBrok\TradeoffAnalytics\Support\DataCollection\Problem;
use FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemColumn;
use FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemColumnCategoricalRange;
use FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemColumnDateRange;
use FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemColumnValueRange;
use FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemOption;
use Orchestra\Testbench\TestCase;

/**
 * Class TestDataCollection
 */
class TestDataCollection extends TestCase
{
    /**
     * The Problem object
     *
     * @var \FindBrok\TradeoffAnalytics\Support\DataCollection\Problem
     */
    protected $problem;

    /**
     * The ProblemColumn object
     *
     * @var \FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemColumn
     */
    protected $problemColumn;

    /**
     * The ProblemOption object
     *
     * @var \FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemOption
     */
    protected $problemOption;

    /**
     * The ProblemCategoricalRange object
     *
     * @var \FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemColumnCategoricalRange
     */
    protected $problemColumnCategoricalRange;

    /**
     * The ProblemColumnDateRange object
     *
     * @var \FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemColumnDateRange
     */
    protected $problemColumnDateRange;

    /**
     * The ProblemColumnValueRange object
     *
     * @var \FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemColumnValueRange
     */
    protected $problemColumnValueRange;

    /**
     * The Faker instance
     *
     * @var \Faker\Factory
     */
    protected $faker;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->problem = $this->app->make('TradeoffProblem');
        $this->problemColumn = $this->app->make('TradeoffProblemColumn');
        $this->problemOption = $this->app->make('TradeoffProblemOption');
        $this->problemColumnCategoricalRange = $this->app->make('TradeoffProblemColumnCategoricalRange');
        $this->problemColumnDateRange = $this->app->make('TradeoffProblemColumnDateRange');
        $this->problemColumnValueRange = $this->app->make('TradeoffProblemColumnValueRange');
        $this->faker = Factory::create();
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        unset($this->problem);
        unset($this->problemColumn);
        unset($this->problemOption);
        unset($this->problemColumnCategoricalRange);
        unset($this->problemColumnDateRange);
        unset($this->problemColumnValueRange);
        unset($this->faker);
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    public function getPackageProviders($app)
    {
        return ['FindBrok\TradeoffAnalytics\TradeoffAnalyticsServiceProvider'];
    }

    /**
     * Test if we can create different Problem Objects and each is different
     *
     * @return void
     */
    public function testProblemObjectCanBeConstructedAndEachIsDifferent()
    {
        $problem = $this->app->make('TradeoffProblem');
        $this->assertInstanceOf(Problem::class, $problem);
        $this->assertNotSame($this->problem, $problem);
    }

    /**
     * Test that we can create ProblemColumn object and each is different
     *
     * @return void
     */
    public function testProblemColumnObjectCanBeConstructedAndEachIsDifferent()
    {
        $problemColumn = $this->app->make('TradeoffProblemColumn');
        $this->assertInstanceOf(ProblemColumn::class, $problemColumn);
        $this->assertNotSame($this->problemColumn, $problemColumn);
    }

    /**
     * Test that we can create ProblemOption object nd each is different
     *
     * @return void
     */
    public function testProblemOptionObjectCanBeConstructedAndEachIsDifferent()
    {
        $problemOption = $this->app->make('TradeoffProblemOption');
        $this->assertInstanceOf(ProblemOption::class, $problemOption);
        $this->assertNotSame($this->problemOption, $problemOption);
    }

    /**
     * Test that we can create ProblemColumnCategoricalRange object and each is different
     *
     * @return void
     */
    public function testProblemColumnCategoricalRangeObjectCanBeConstructedAndEachIsDifferent()
    {
        $problemColumnCategoricalRange = $this->app->make('TradeoffProblemColumnCategoricalRange');
        $this->assertInstanceOf(ProblemColumnCategoricalRange::class, $problemColumnCategoricalRange);
        $this->assertNotSame($this->problemColumnCategoricalRange, $problemColumnCategoricalRange);
    }

    /**
     * Test that we can create ProblemColumnDateRange object and each is different
     *
     * @return void
     */
    public function testProblemColumnDateRangeObjectCanBeConstructedAndEachIsDifferent()
    {
        $problemColumnDateRange = $this->app->make('TradeoffProblemColumnDateRange');
        $this->assertInstanceOf(ProblemColumnDateRange::class, $problemColumnDateRange);
        $this->assertNotSame($this->problemColumnDateRange, $problemColumnDateRange);
    }

    /**
     * Test that we can create ProblemColumnValueRange object and each is different
     *
     * @return void
     */
    public function testProblemColumnValueRangeObjectCanBeConstructedAndEachIsDifferent()
    {
        $problemColumnValueRange = $this->app->make('TradeoffProblemColumnValueRange');
        $this->assertInstanceOf(ProblemColumnValueRange::class, $problemColumnValueRange);
        $this->assertNotSame($this->problemColumnValueRange, $problemColumnValueRange);
    }

    /**
     * Test ProblemObject Accepts Supported Fields
     *
     * @return void
     */
    public function testProblemObjectAcceptsSupportedFields()
    {
        $problem = $this->app->make('TradeoffProblem', [
            'subject' => 'Foo',
            'columns' => ['x' => 'bar'],
            'options' => ['bar' => 'foo'],
            'Foo' => 'Bar'
        ]);
        $this->assertEquals([
            'subject' => 'Foo',
            'columns' => ['x' => 'bar'],
            'options' => ['bar' => 'foo']
        ], $problem->all());
    }

    /**
     * Test that if we put wrong field in the Problem object we get an exception
     *
     * @return void
     */
    public function testProblemObjectThrowUnsupportedExceptionWhenWrongFieldIsPut()
    {
        try {
            $this->problem->put('Foo', 'Bar');
        } catch (DataCollectionUnsupportedFieldException $e) {
            $this->assertEquals(
                'Tradeoff Analytics DataCollectionException: Unsupported field {Foo} in {FindBrok\TradeoffAnalytics\Support\DataCollection\Problem} Object',
                $e->getMessage()
            );
        }
    }

    /**
     * Test that the ProblemColumn object accepts only supported fields
     *
     * @return void
     */
    public function testProblemColumnObjectAcceptsSupportedFields()
    {
        $problemColumn = $this->app->make('TradeoffProblemColumn', [
            'key' => '123',
            'type' => 'numeric',
            'Foo' => 'Bar'
        ]);
        $this->assertEquals([
            'key' => '123',
            'type' => 'numeric',
        ], $problemColumn->all());
    }

    /**
     * Test that if we put wrong field in the ProblemColumn object we get an exception
     *
     * @return void
     */
    public function testProblemColumnObjectThrowUnsupportedExceptionWhenWrongFieldIsPut()
    {
        try {
            $this->problemColumn->put('Foo', 'Bar');
        } catch (DataCollectionUnsupportedFieldException $e) {
            $this->assertEquals(
                'Tradeoff Analytics DataCollectionException: Unsupported field {Foo} in {FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemColumn} Object',
                $e->getMessage()
            );
        }
    }

    /**
     * Test that the ProblemOption object accepts only supported fields
     *
     * @return void
     */
    public function testProblemOptionObjectAcceptsSupportedFields()
    {
        $problemOption = $this->app->make('TradeoffProblemOption', [
            'key' => '123',
            'values' => ['X', 'Foo'],
            'Foo' => 'Bar'
        ]);
        $this->assertEquals([
            'key' => '123',
            'values' => ['X', 'Foo'],
        ], $problemOption->all());
    }

    /**
     * Test that if we put wrong field in the ProblemOption object we get an exception
     *
     * @return void
     */
    public function testProblemOptionObjectThrowUnsupportedExceptionWhenWrongFieldIsPut()
    {
        try {
            $this->problemOption->put('Foo', 'Bar');
        } catch (DataCollectionUnsupportedFieldException $e) {
            $this->assertEquals(
                'Tradeoff Analytics DataCollectionException: Unsupported field {Foo} in {FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemOption} Object',
                $e->getMessage()
            );
        }
    }

    /**
     * Test that the ProblemColumnCategoricalRange object can accept any field
     *
     * @return void
     */
    public function testProblemColumnCategoricalRangeObjectAcceptsAnyField()
    {
        $problemColumnCategoricalRange = $this->app->make('TradeoffProblemColumnCategoricalRange', [
            'Foo',
            'Bar',
            'X-Foo'
        ]);
        $this->assertEquals([
            'Foo',
            'Bar',
            'X-Foo'
        ], $problemColumnCategoricalRange->all());
    }

    /**
     * Test we can push any value in the ProblemColumnCategoricalRange object
     *
     * @return void
     */
    public function testProblemColumnCategoricalRangeObjectCanPush()
    {
        $this->problemColumnCategoricalRange->push('Bar');
        $this->problemColumnCategoricalRange->push('Foo');
        $this->assertEquals([
            'Bar',
            'Foo'
        ], $this->problemColumnCategoricalRange->all());
    }

    /**
     * Test that the ProblemColumnDateRange object accepts only supported fields
     *
     * @return void
     */
    public function testProblemColumnDateRangeObjectAcceptsSupportedFields()
    {
        $low = Carbon::createFromFormat('Y-m-d H:i:s', $this->faker->dateTimeBetween('-3 years')->format('Y-m-d H:i:s'));
        $high = Carbon::createFromFormat('Y-m-d H:i:s', $this->faker->dateTimeBetween('now', '+3 years')->format('Y-m-d H:i:s'));
        $problemColumnDateRange = $this->app->make('TradeoffProblemColumnDateRange', [
            'high' => $high,
            'low' => $low,
            'Foo' => 'Bar'
        ]);
        $this->assertEquals([
            'high' => $high->toIso8601String(),
            'low' => $low->toIso8601String(),
        ], $problemColumnDateRange->all());
    }

    /**
     * Test that if we put wrong field in the ProblemColumnDateRange object we get an exception
     *
     * @return void
     */
    public function testProblemColumnDateRangeThrowUnsupportedExceptionWhenWrongFieldIsPut()
    {
        try {
            $this->problemColumnDateRange->put('Foo', 'Bar');
        } catch (DataCollectionUnsupportedFieldException $e) {
            $this->assertEquals(
                'Tradeoff Analytics DataCollectionException: Unsupported field {Foo} in {FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemColumnDateRange} Object',
                $e->getMessage()
            );
        }
    }

    /**
     * Test that the ProblemColumnValueRange object accepts only supported fields
     *
     * @return void
     */
    public function testProblemColumnValueRangeObjectAcceptsSupportedFields()
    {
        $problemColumnValueRange = $this->app->make('TradeoffProblemColumnValueRange', [
            'high' => 100,
            'low' => 10,
            'Foo' => 'Bar'
        ]);
        $this->assertEquals([
            'high' => 100,
            'low' => 10,
        ], $problemColumnValueRange->all());
    }

    /**
     * Test that if we put wrong field in the ProblemColumnValueRange object we get an exception
     *
     * @return void
     */
    public function testProblemColumnValueRangeThrowUnsupportedExceptionWhenWrongFieldIsPut()
    {
        try {
            $this->problemColumnValueRange->put('Foo', 'Bar');
        } catch (DataCollectionUnsupportedFieldException $e) {
            $this->assertEquals(
                'Tradeoff Analytics DataCollectionException: Unsupported field {Foo} in {FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemColumnValueRange} Object',
                $e->getMessage()
            );
        }
    }

    /**
     * Test that we can add some data in the ProblemColumn object
     *
     * @return void
     */
    public function testAddDataInProblemColumnObject()
    {
        $this->problemColumn->add([
            'key' => '123',
            'description' => 'something',
        ]);
        $this->assertCount(2, $this->problemColumn);
    }

    /**
     * Test that we can add ProblemColumn object to Problem object
     *
     * @return void
     */
    public function testAddColumnsToProblemObject()
    {
        $columns = [
            $this->app->make('TradeoffProblemColumn', [
                'key' => '123',
                'description' => 'something',
            ]),
            $this->app->make('TradeoffProblemColumn', [
                'key' => '456',
                'description' => 'something else',
            ]),
        ];
        $this->problem->addColumns($columns);
        $this->assertCount(2, $this->problem->get('columns'));
        $this->problem->addColumns(
            $this->app->make('TradeoffProblemColumn', [
                'key' => '789',
                'description' => 'another something else',
            ])
        );
        $this->assertCount(3, $this->problem->get('columns'));
    }

    /**
     * Test that we can add data to ProblemOption object
     *
     * @return void
     */
    public function testAddDataToProblemOptionObject()
    {
        $this->problemOption->add([
            'key' => '123',
            'name' => 'Lorem Ipsum',
        ]);
        $this->assertCount(2, $this->problemOption);
    }

    /**
     * Test that we can add ProblemOption to Problem object
     *
     * @return void
     */
    public function testAddOptionsToProblemObject()
    {
        $options = [
            $this->app->make('TradeoffProblemOption', [
                'key' => '123',
                'name' => 'Some name'
            ]),
            $this->app->make('TradeoffProblemOption', [
                'key' => '456',
                'name' => 'Another name'
            ]),
        ];
        $this->problem->addOptions($options);
        $this->assertCount(2, $this->problem->get('options'));
        $this->problem->addOptions($this->app->make('TradeoffProblemOption', [
            'key' => '789',
            'name' => 'My name'
        ]));
        $this->assertCount(3, $this->problem->get('options'));
    }

    /**
     * Test that we can add fields to ProblemColumnCategoricalRange object
     *
     * @return void
     */
    public function testProblemColumnCategoricalRangeAddRangeFields()
    {
        $this->problemColumnCategoricalRange->defineRange([
            'Apple',
            'HTC',
            'Samsung',
            'Sony'
        ]);
        $this->assertCount(4, $this->problemColumnCategoricalRange);
    }

    /**
     * Test that we can add fields to ProblemColumnDateRange object
     *
     * @return void
     */
    public function testProblemColumnDateRangeAddRangeFields()
    {
        $low = Carbon::createFromFormat('Y-m-d H:i:s', $this->faker->dateTimeBetween('-3 years')->format('Y-m-d H:i:s'));
        $high = Carbon::createFromFormat('Y-m-d H:i:s', $this->faker->dateTimeBetween('now', '+3 years')->format('Y-m-d H:i:s'));
        $this->problemColumnDateRange->defineRange([
            'low' => $low,
            'high' => $high
        ]);
        $this->assertCount(2, $this->problemColumnDateRange);
        $this->assertEquals([
            'low' => $low->toIso8601String(),
            'high' => $high->toIso8601String()
        ], $this->problemColumnDateRange->all());
    }

    /**
     * Test that we can add fields to the ProblemColumnValueRange object
     *
     * @return void
     */
    public function testProblemColumnValueRangeAddRangeFields()
    {
        $this->problemColumnValueRange->defineRange([
            'low' => '1',
            'high' => 40
        ]);
        $this->assertCount(2, $this->problemColumnValueRange);
        $this->assertEquals([
            'low' => 1,
            'high' => 40
        ], $this->problemColumnValueRange->all());
    }

    /**
     * Test that we can add Range objects to ProblemColumn
     *
     * @return void
     */
    public function testCanAddRangeObjectsToProblemColumn()
    {
        $this->problemColumn->addRange(
            $this->problemColumnValueRange->defineRange([
                'low' => 10,
                'high' => 100
            ])
        );
        $this->assertInstanceOf(ProblemColumnValueRange::class, $this->problemColumn->get('range'));
    }

    /**
     * Test that we can get the problem statement from the problem object
     *
     * @return void
     */
    public function testGetProblemStatementFromProblemObject()
    {
        $problem = $this->app->make('TradeoffProblem', [
            'subject' => 'phones',
            'columns' => [
                $this->app->make('TradeoffProblemColumn', [
                    'key' => 'price',
                    'type' => 'numeric',
                    'goal' => 'min',
                    'is_objective' => true,
                    'full_name' =>'Price',
                    'range' => $this->app->make('TradeoffProblemColumnValueRange', [
                        'low' => 0,
                        'high' => 400
                    ]),
                    'format' => 'number:2'
                ])
            ],
            'options' => [
                $this->app->make('TradeoffProblemOption', [
                    'key' => '1',
                    'name' => 'Samsung Galaxy S4',
                    'values' => [
                        'price' => 249
                    ]
                ]),
                $this->app->make('TradeoffProblemOption', [
                    'key' => '2',
                    'name' => 'Apple iPhone 5',
                    'values' => [
                        'price' => 449
                    ]
                ]),
            ]
        ]);

        $this->assertEquals([
            'subject' => 'phones',
            'columns' => [
                [
                    'key' => 'price',
                    'type' => 'numeric',
                    'goal' => 'min',
                    'is_objective' => true,
                    'full_name' =>'Price',
                    'range' => [
                        'low' => 0,
                        'high' => 400
                    ],
                    'format' => 'number:2'
                ]
            ],
            'options' => [
                [
                    'key' => '1',
                    'name' => 'Samsung Galaxy S4',
                    'values' => [
                        'price' => 249
                    ]
                ],
                [
                    'key' => '2',
                    'name' => 'Apple iPhone 5',
                    'values' => [
                        'price' => 449
                    ]
                ]
            ]
        ], $problem->statement());
    }
}
