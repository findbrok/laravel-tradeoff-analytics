<?php

namespace FindBrok\TradeoffAnalytics\Support\DataCollection;

/**
 * Class Problem
 *
 * @package FindBrok\TradeoffAnalytics\Support\DataCollection
 */
class Problem extends BaseCollector
{
    /**
     * List of Supported Field Names
     *
     * @var array
     */
    protected $supportedFields = [
        /*
        |--------------------------------------------------------------------------
        | Subject (String | Required)
        |--------------------------------------------------------------------------
        | 
        | A name for the decision problem. The field typically provides a heading
        | for the column that represents the options in the tabular
        | representation of the data.
        |
        */

        'subject',

        /*
        |--------------------------------------------------------------------------
        | Columns (Object | Required)
        |--------------------------------------------------------------------------
        |
        | An array of ProblemColumn objects that lists the objectives for the
        | decision problem. The field typically specifies the columns
        | for the tabular representation of the data.
        |
        */

        'columns',

        /*
        |--------------------------------------------------------------------------
        | Options (Object | Required)
        |--------------------------------------------------------------------------
        | 
        | An array of ProblemOption objects that lists the options for the
        | decision problem. The field typically specifies the rows for
        | the tabular representation of the data
        |
        */

        'options'
    ];
}
