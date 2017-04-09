<?php

namespace FindBrok\TradeoffAnalytics\Models\Resolution;

use FindBrok\TradeoffAnalytics\Models\AbstractModel as Model;

class ExcludedBy extends Model
{
    /**
     * The key that uniquely identifies the option that was strictly better than the current option.
     *
     * @var string
     */
    protected $solution_ref;

    /**
     * A collection of Objective objects that describes each value of the superior option that was strictly better than
     * the current option.
     *
     * @var \Illuminate\Support\Collection[Objective]|null
     */
    protected $objectives;
}
