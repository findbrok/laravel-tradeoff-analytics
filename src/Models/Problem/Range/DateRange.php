<?php

namespace FindBrok\TradeoffAnalytics\Models\Problem\Range;

use FindBrok\TradeoffAnalytics\Models\AbstractModel as Model;

class DateRange extends Model
{
    /**
     * The low end of the range in full ISO 8601 format.
     *
     * @var string
     */
    protected $low;

    /**
     * The high end of the range in full ISO 8601 format.
     *
     * @var string
     */
    protected $high;
}
