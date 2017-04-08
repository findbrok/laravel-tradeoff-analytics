<?php

namespace FindBrok\TradeoffAnalytics\Models\Problem\Range;

use FindBrok\TradeoffAnalytics\Models\AbstractModel as Model;

class CategoricalRange extends Model
{
    /**
     * The values in the range. By default, values are preferred in the order in
     * which you list them. The column's goal field indicates the order of preference.
     * If goal is min, elements in the low position (at the front) of the array are
     * preferred; if goal is max, elements in the high position are preferred.
     * Use the preference field to list a subset of the elements in the
     * range in their preferred order.
     *
     * @var array
     */
    protected $range;
}
