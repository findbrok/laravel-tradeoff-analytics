<?php

namespace FindBrok\TradeoffAnalytics\Models\Resolution;

use Jstewmc\PhpHelpers\Num;
use FindBrok\TradeoffAnalytics\Models\AbstractModel as Model;

class Objective extends Model
{
    /**
     * The key that uniquely identifies the column (objective) of the superior option whose value was better than the
     * corresponding value of the current option.
     *
     * @var string
     */
    protected $key;

    /**
     * The difference between the values of the superior option and the current option for the column (objective). The
     * difference can be an integer or a double depending on the column definition.
     *
     * @var int|float
     */
    protected $difference;

    /**
     * For categorical columns, a description of the difference between the two values as a preference; for example,
     * Prefer category_one over category_two. For datetime columns, a description of the difference between the two
     * values as a number of days, hours, and minutes, as needed; for example, 350 days or 225 days 21 hours 30
     * minutes.
     *
     * @var string|null
     */
    protected $text;

    /**
     * Sets difference to the model.
     *
     * @param string $difference
     *
     * @return $this
     */
    public function setDifference($difference)
    {
        $this->difference = Num::val($difference);

        return $this;
    }
}
