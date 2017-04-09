<?php

namespace FindBrok\TradeoffAnalytics\Models\Resolution;

use FindBrok\TradeoffAnalytics\Models\AbstractModel as Model;

class StatusCause extends Model
{
    /**
     * A description in English of the cause for the option's status.
     *
     * @var string
     */
    protected $message;

    /**
     * Elements of the message field that describes the cause for the option's status.
     *
     * @var array
     */
    protected $tokens;

    /**
     * The cause of the option's status:
     *  - MISSING_OBJECTIVE_VALUE indicates that a column for which the is_objective field is true is absent from the
     *    option's specification.
     *  - RANGE_MISMATCH indicates that the option's specification defines a value that is outside
     *    of the range specified for an objective.
     *  - DOES_NOT_MEET_PREFERENCE indicates that a categorical column value for
     *    the option is not included among the preferences for that column.
     *
     * @var string
     */
    protected $error_code;
}
