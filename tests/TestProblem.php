<?php

namespace FindBrok\TradeoffAnalytics\Tests;

use FindBrok\TradeoffAnalytics\Models\Problem\Problem;

class TestProblem extends AbstractTestCase
{
    /**
     * Test that the problem can be converted to array.
     *
     * @return void
     */
    public function testProblemToArrayMethod()
    {
        $problemArray = $this->app->make(Problem::class)
                                  ->setData([
                                      'subject' => 'phones',
                                      'columns' => $this->getColumns(),
                                      'options' => $this->getOptions(),
                                  ])
                                  ->toArray();

        $this->assertArrayHasKey('subject', $problemArray);
        $this->assertArrayHasKey('columns', $problemArray);
        $this->assertArrayHasKey('options', $problemArray);
        $this->assertEquals('phones', $problemArray['subject']);
        $this->assertEquals($this->getColumns(), $problemArray['columns']);
        $this->assertEquals($this->getOptions(), $problemArray['options']);
    }

    /**
     * Tests that the toJson method works
     * as expected on the Problem object.
     *
     * @return void
     */
    public function testProblemToJsonMethod()
    {
        $problemJson = $this->app->make(Problem::class)
                                 ->setData([
                                     'subject' => 'phones',
                                     'columns' => $this->getColumns(),
                                     'options' => $this->getOptions(),
                                 ])->toJson();

        $this->assertJson($problemJson);
        $this->assertJsonStringEqualsJsonString(json_encode([
            'subject' => 'phones',
            'columns' => $this->getColumns(),
            'options' => $this->getOptions(),
        ]), $problemJson);
    }

    /**
     * Get Options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            [
                'key'    => '1',
                'name'   => 'Samsung Galaxy S4',
                'values' => [
                    'price'  => 249,
                    'weight' => 130,
                    'brand'  => 'Samsung',
                    'rDate'  => '2013-04-29T00:00:00Z',
                ],
            ],
        ];
    }

    /**
     * Get Columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'key'          => 'price',
                'type'         => 'numeric',
                'goal'         => 'min',
                'is_objective' => true,
                'range'        => [
                    'low'  => 0,
                    'high' => 400,
                ],
                'format'       => 'number:2',
                'full_name'    => 'Price',
            ],
        ];
    }
}
