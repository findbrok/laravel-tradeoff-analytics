<?php

namespace FindBrok\TradeoffAnalytics\Models\Resolution;

use Jstewmc\PhpHelpers\Num;
use FindBrok\TradeoffAnalytics\Models\AbstractModel as Model;

class PreferableSolutions extends Model
{
    /**
     * The keys that uniquely identify the preferred options of the decision problems. The service chooses the
     * preferred solutions from among its set of best candidates. These are the solutions most likely to be selected by
     * the greatest number of users. The service usually identifies no more than five preferred solutions, typically
     * three or fewer.
     *
     * @var array
     */
    protected $solution_refs;

    /**
     * A confidence score that indicates the percentage of users who are likely to choose one of the preferred
     * solutions. The higher the percentage, the greater the service's confidence in its selections.
     *
     * @var int|float
     */
    protected $score;

    /**
     * Sets the score to the model.
     *
     * @param string $score
     *
     * @return $this
     */
    public function setScore($score)
    {
        $this->score = Num::val($score);

        return $this;
    }
}
