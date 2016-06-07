<?php

namespace FindBrok\TradeoffAnalytics\Support\DataCollection;

use Exception;

/**
 * Class ProblemColumnValueRange.
 */
class ProblemColumnValueRange extends BaseCollectorRange
{
    /**
     * List of Supported Field Names.
     *
     * @var array
     */
    protected $supportedFields = [

        /*
        |--------------------------------------------------------------------------
        | Low (String | Required)
        |--------------------------------------------------------------------------
        |
        | The low end of the range.
        |
        */

        'low',

        /*
        |--------------------------------------------------------------------------
        | High (String | Required)
        |--------------------------------------------------------------------------
        |
        | The high end of the range.
        |
        */

        'high',
    ];

    /**
     * Add Range Fields to Range object.
     *
     * @param array $range
     *
     * @throws
     *
     * @return self
     */
    public function defineRange($range = [])
    {
        //Collect range
        $range = collect($range);
        //Validate Range
        if (!$range->has('high') && !$range->has('low')) {
            throw new Exception('Missing {high} or {low} field in {ProblemColumnValueRange} object', 422);
        }
        //Transform to int
        $this->items = $range->transform(function ($item) {
            return (int) $item;
        })->all();
        //Return calling object
        return $this;
    }
}
