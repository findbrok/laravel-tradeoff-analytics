<?php

namespace FindBrok\TradeoffAnalytics\Support\DataCollection;

class ProblemColumn extends BaseCollector
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
        | An identifier for the column. The key must be unique among all
        | columns for the decision problem.
        |
        */

        'key',

        /*
        |--------------------------------------------------------------------------
        | Type (String | Optional)
        |--------------------------------------------------------------------------
        |
        | The type of the column's values:
        |  - numeric: columns accept number values (integers or doubles).
        |  - datetime: columns accept date and time values in full ISO 8601 format (YYYY-MM-DDThh:mm:ss.sTZD).
        |  - categorical: columns accepts string values specified by using the range field.
        |  - text: (the default) columns accept strings.
        |
        */

        'type',

        /*
        |--------------------------------------------------------------------------
        | Goal (String | Optional)
        |--------------------------------------------------------------------------
        |
        | The direction of the column:
        | - min: indicates that the goal is to minimize the objective (for example, the price of a vehicle).
        | - max: (the default) indicates that the goal is to maximize the objective (for example, the safety rating of a vehicle).
        | The goal is meaningful only for columns for which is_objective is true.
        |
        */

        'goal',

        /*
        |--------------------------------------------------------------------------
        | Is Objective (Boolean | Optional)
        |--------------------------------------------------------------------------
        |
        | Indicates whether the column is an objective for the decision problem.
        | If true, the column contributes to the resolution; if false
        | (the default), the column does not contribute to the
        | resolution. A column of type text cannot be set
        | to true. If generate_visualization is true,
        | is_objective must be true for a minimum
        | of three columns and a maximum
        | of 10 columns.
        |
        */

        'is_objective',

        /*
        |--------------------------------------------------------------------------
        | Range (Object | Optional)
        |--------------------------------------------------------------------------
        |
        | A ProblemColumnCategoricalRange, ProblemColumnDateRange, or
        | ProblemColumnValueRange object that indicates the
        | range of valid values for a categorical, datetime, or numeric column,
        | respectively. An option whose value is outside of the specified
        | range is marked as incomplete and is excluded from the
        | resolution. By default, the range is calculated from
        | the minimum and maximum values provided in the data
        | set for the column.
        |
        */

        'range',

        /*
        |--------------------------------------------------------------------------
        | Preference (String | Object)
        |--------------------------------------------------------------------------
        |
        | For columns whose type is categorical, a preferred subset of the strings
        | in the column's range; valid only for categorical columns. The order of the
        | values is important because it indicates the actual preference for the values in range:
        |  - If goal is min, elements in the low position (at the front) of the array are favored over later elements.
        |  - if goal is max, elements in the high position of the array are favored.
        | By default, values are preferred according to their ordering in range and the direction indicated by goal.
        |
        */

        'preference',

        /*
        |--------------------------------------------------------------------------
        | Significant Gain (Number | Optional)
        |--------------------------------------------------------------------------
        |
        | A significant gain for the column in the range of 0 to 1. The value is a
        | proportion of the complete range for the column. The field is relevant
        | only for columns whose is_objective field is true.
        |
        */

        'significant_gain',

        /*
        |--------------------------------------------------------------------------
        | Significant Loss (Number | Optional)
        |--------------------------------------------------------------------------
        |
        | A significant loss for the column in the range of 0 to 1. The value is a
        | proportion of the complete range for the column. The field is relevant
        | only for columns whose is_objective field is true.
        |
        */

        'significant_loss',

        /*
        |--------------------------------------------------------------------------
        | Insignificant Loss (Number | Optional)
        |--------------------------------------------------------------------------
        |
        | An insignificant loss for the column in the range of 0 to 1. The value is a
        | proportion of the complete range for the column. The field is relevant only
        | for columns whose is_objective field is true.
        |
        */

        'insignificant_loss',

        /*
        |--------------------------------------------------------------------------
        | Format (String | Optional)
        |--------------------------------------------------------------------------
        |
        | For columns whose type is numeric or datetime, an optional pattern that indicates
        | how the value is to be presented by the visualization. For numeric columns:
        | - Number of decimal places: "format": "number: n"
        | - Currency symbol and number of decimal places: "format": "currency: 'symbol' : n"
        | - Prefix: "format": "taPrefix: 'symbol'"
        | - Suffix: "format": "taSuffix: 'symbol'"
        | - Combinations: "format": "number: n | taSuffix: 'symbol'"
        | For datetime columns:
        | - Date: "format": "date: 'MMM dd, yyyy'"
        | - Time: "format": "date: 'h:m:s a'"
        | - Date and time: "format": "date: 'MMM dd, yyyy h:m:s a'"
        |
        */

        'format',

        /*
        |--------------------------------------------------------------------------
        | Full Name (String | Optional)
        |--------------------------------------------------------------------------
        |
        | A descriptive name for the column. Used only by the Tradeoff
        | Analytics widget; not part of the problem definition.
        |
        */

        'full_name',

        /*
        |--------------------------------------------------------------------------
        | Description
        |--------------------------------------------------------------------------
        |
        | A long description for the column. Used only by the Tradeoff Analytics
        | widget; not part of the problem definition.
        |
        */

        'description',
    ];

    /**
     * Add a Range object to the Column.
     *
     * @param mixed $range
     *
     * @return self
     */
    public function addRange($range)
    {
        $this->put('range', $range);

        return $this;
    }
}
