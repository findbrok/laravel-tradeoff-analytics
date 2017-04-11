<?php

namespace FindBrok\TradeoffAnalytics\Models\Problem;

use FindBrok\TradeoffAnalytics\Models\AbstractModel as Model;
use FindBrok\TradeoffAnalytics\Models\Problem\Range\DateRange;
use FindBrok\TradeoffAnalytics\Models\Problem\Range\ValueRange;
use FindBrok\TradeoffAnalytics\Models\Problem\Range\CategoricalRange;

class Column extends Model
{
    /**
     * An identifier for the column. The key
     * must be unique among all columns
     * for the decision problem.
     *
     * @var string
     */
    protected $key;

    /**
     * The type of the column's values:
     *  - numeric columns accept number values (integers or doubles).
     *  - datetime columns accept date and time values in full ISO 8601 format (YYYY-MM-DDThh:mm:ss.sTZD).
     *  - categorical columns accepts string values specified by using the range field.
     *  - text (the default) columns accept strings.
     *
     * @var string
     */
    protected $type;

    /**
     * The direction of the column:
     *  - min indicates that the goal is to minimize the objective (for example, the price of a vehicle).
     *  - max (the default) indicates that the goal is to maximize the objective (for example, the safety rating of a
     *  vehicle). The goal is meaningful only for columns for which is_objective is true.
     *
     * @var string
     */
    protected $goal;

    /**
     * Indicates whether the column is an objective for the decision problem. If true, the column
     * contributes to the resolution; if false (the default), the column does not contribute to
     * the resolution. The value cannot be set to true for a column of type text.
     * If generate_visualization is true, is_objective must be true for a
     * minimum of three columns and a maximum of 10 columns.
     *
     * @var bool
     */
    protected $is_objective = false;

    /**
     * A CategoricalRange, DateRange, or ValueRange object that indicates the range of valid values for
     * a categorical, datetime, or numeric column, respectively. An option whose value is outside of
     * the specified range is marked as INCOMPLETE and is excluded from the resolution. By default,
     * the range is calculated from the minimum and maximum values provided in the data
     * set for the column.
     *
     * @var CategoricalRange|DateRange|ValueRange
     */
    protected $range;

    /**
     * For columns whose type is categorical, a preferred subset of the strings in the column's range; valid
     * only for categorical columns. The order of the values is important because it indicates the actual
     * preference for the values in range:
     *  - If goal is min, elements in the low position (at the front) of the array are favored over later elements.
     *  - If goal is max, elements in the high position of the array are favored.
     * By default, values are preferred according to their ordering in range and the direction indicated by goal.
     *
     * @var string[]
     */
    protected $preference;

    /**
     * A significant gain for the column in the range of 0 to 1. The value is a proportion of the complete
     * range for the column. The field is relevant only for columns whose is_objective field is true.
     *
     * @var float
     */
    protected $significant_gain;

    /**
     * A significant loss for the column in the range of 0 to 1. The value is a proportion of the complete
     * range for the column. The field is relevant only for columns whose is_objective field is true.
     *
     * @var float
     */
    protected $significant_loss;

    /**
     * An insignificant loss for the column in the range of 0 to 1. The value is a proportion of the complete
     * range for the column. The field is relevant only for columns whose is_objective field is true.
     *
     * @var float
     */
    protected $insignificant_loss;

    /**
     * For columns whose type is numeric or datetime, an optional pattern that indicates how the value is to be
     * presented by the visualization.
     *
     * For numeric columns:
     *  - Number of decimal places: "format": "number: n"
     *  - Currency symbol and number of decimal places: "format": "currency: 'symbol' : n"
     *  - Prefix: "format": "taPrefix: 'symbol'"
     *  - Suffix: "format": "taSuffix: 'symbol'"
     *  - Combinations: "format": "number: n | taSuffix: 'symbol'"
     *
     * For datetime columns:
     *  - Date: "format": "date: 'MMM dd, yyyy'"
     *  - Time: "format": "date: 'h:m:s a'"
     *  - Date and time: "format": "date: 'MMM dd, yyyy h:m:s a'"
     *
     * @var string
     */
    protected $format;

    /**
     * A descriptive name for the column. Used only by the Tradeoff Analytics widget; not part of the problem
     * definition.
     *
     * @var string
     */
    protected $full_name;

    /**
     * A long description for the column. Used only by the Tradeoff Analytics widget; not part of the problem
     * definition.
     *
     * @var string
     */
    protected $description;

    /**
     * Sets the range to the model.
     *
     * @param array|null $range
     *
     * @return $this
     */
    public function setRange($range)
    {
        // Null Range.
        if (is_null($range)) {
            $this->range = $range;

            return $this;
        }

        // Type is Numeric.
        if ($this->isNumeric()) {
            $this->range = (new ValueRange)->mapArrayDataToModel($range);

            return $this;
        }

        // Type is Datetime.
        if ($this->isDatetime()) {
            $this->range = (new DateRange)->mapArrayDataToModel($range);

            return $this;
        }

        // Type is Categorical.
        if ($this->isCategorical()) {
            $this->range = (new CategoricalRange)->mapArrayDataToModel(['range' => $range]);
        }

        return $this;
    }

    /**
     * Checks if column is numeric type.
     *
     * @return bool
     */
    public function isNumeric()
    {
        return $this->type == 'numeric';
    }

    /**
     * Checks if column is datetime type.
     *
     * @return bool
     */
    public function isDatetime()
    {
        return $this->type == 'datetime';
    }

    /**
     * Checks if column is categorical type.
     *
     * @return bool
     */
    public function isCategorical()
    {
        return $this->type == 'categorical';
    }

    /**
     * Checks if column is text type.
     *
     * @return bool
     */
    public function isText()
    {
        return $this->type == 'text';
    }
}
