<?php

namespace FindBrok\TradeoffAnalytics\Models\Problem\Range;

use Jstewmc\PhpHelpers\Num;
use FindBrok\TradeoffAnalytics\Models\AbstractModel as Model;

class ValueRange extends Model
{
    /**
     * The low end of the range.
     *
     * @var int|double
     */
    protected $low;

    /**
     * The high end of the range.
     *
     * @var int|double
     */
    protected $high;

    /**
     * Sets low to the model.
     *
     * @param string $low
     *
     * @return $this
     */
    public function setLow($low)
    {
        $this->low = Num::val($low);

        return $this;
    }

    /**
     * Sets high to the model.
     *
     * @param string $high
     *
     * @return $this
     */
    public function setHigh($high)
    {
        $this->high = Num::val($high);

        return $this;
    }
}
