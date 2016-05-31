<?php

namespace FindBrok\TradeoffAnalytics\Support\DataCollection;

/**
 * Class ProblemColumnValueRange
 *
 * @package FindBrok\TradeoffAnalytics\Support\DataCollection
 */
class ProblemColumnValueRange extends BaseCollectorRange
{
    /**
     * List of Supported Field Names
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

        'high'
    ];
}
