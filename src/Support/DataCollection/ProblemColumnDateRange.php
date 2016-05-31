<?php

namespace FindBrok\TradeoffAnalytics\Support\DataCollection;

/**
 * Class ProblemColumnDateRange
 *
 * @package FindBrok\TradeoffAnalytics\Support\DataCollection
 */
class ProblemColumnDateRange extends BaseCollectorRange
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
        | The low end of the range in full ISO 8601 format.
        | 
        */

        'low',

        /*
        |--------------------------------------------------------------------------
        | High (String | Required)
        |--------------------------------------------------------------------------
        |
        | The high end of the range in full ISO 8601 format.
        |
        */

        'high'
    ];
}
