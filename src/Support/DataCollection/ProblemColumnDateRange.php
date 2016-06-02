<?php

namespace FindBrok\TradeoffAnalytics\Support\DataCollection;

use Carbon\Carbon;
use Exception;
use FindBrok\TradeoffAnalytics\Exceptions\DataCollectionFieldMissMatchTypeException;

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

    /**
     * Add Range Fields to Range object
     *
     * @param array $range
     * @throws DataCollectionFieldMissMatchTypeException
     * @throws Exception
     * @return self
     */
    public function defineRange($range = [])
    {
        //Collect range
        $range = collect($range);
        //Validate Range
        if (! $range->has('high') && ! $range->has('low')) {
            throw new Exception('Missing {high} or {low} field in {ProblemColumnDateRange} object', 422);
        }
        //Transform to toIso8601String
        $this->items = $range->transform(function ($item, $key) {
            if (! $item instanceof Carbon) {
                throw new DataCollectionFieldMissMatchTypeException($key, 'ProblemColumnCategoricalRange', 'Carbon\Carbon');
            }
            return $item->toIso8601String();
        })->all();
        //Return calling object
        return $this;
    }
}
