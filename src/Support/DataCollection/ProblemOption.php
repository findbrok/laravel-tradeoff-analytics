<?php

namespace FindBrok\TradeoffAnalytics\Support\DataCollection;

/**
 * Class ProblemOption.
 */
class ProblemOption extends BaseCollector
{
    /**
     * List of Supported Field Names.
     *
     * @var array
     */
    protected $supportedFields = [
        /*
        |--------------------------------------------------------------------------
        | Key (String | Required)
        |--------------------------------------------------------------------------
        |
        | An identifier for the option. The key must be unique among all options
        | for the decision problem.
        |
        */

        'key',

        /*
        |--------------------------------------------------------------------------
        | Values (Mixed | Required)
        |--------------------------------------------------------------------------
        |
        | A map of key-value pairs that specifies a value for each column (objective)
        | of the decision problem in the format
        | "values": { "key1": value1, "key2": value2 }.
        | Value requirements vary by column type; a value must be of the type
        | defined for its column. An option that fails to specify a value for a column
        | for which is_objective is true is marked as incomplete and is excluded from
        | the resolution.
        |
        */

        'values',

        /*
        |--------------------------------------------------------------------------
        | Name (String | Optional)
        |--------------------------------------------------------------------------
        |
        | The name of the option. Used only by the Tradeoff Analytics widget;
        | not part of the problem definition.
        |
        */

        'name',

        /*
        |--------------------------------------------------------------------------
        | Description (String | Optional)
        |--------------------------------------------------------------------------
        |
        | A description of the option in HTML format. The description is
        | displayed when the user selects the option in the interface.
        | Used only by the Tradeoff Analytics widget; not part of
        | the problem definition.
        |
        */

        'description_html',

        /*
        |--------------------------------------------------------------------------
        | App Data (Mixed | Optional)
        |--------------------------------------------------------------------------
        |
        | A map of key-value pairs in which the application can pass
        | application-specific information in the format
        | "app_data": { "key1": value1, "key2": value2 }.
        | The service carries the information but does
        | not use it. Used only by the Tradeoff
        | Analytics widget; not part of the
        | problem definition.
        |
        */

        'app_data',
    ];
}
