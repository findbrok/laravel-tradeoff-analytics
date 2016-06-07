<?php

namespace FindBrok\TradeoffAnalytics\Support\DataCollection;

/**
 * Class BaseCollectorRange.
 */
class BaseCollectorRange extends BaseCollector
{
    /**
     * Create new instance of the Collector.
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        //We have range
        if (!empty($items)) {
            $this->defineRange($this->filterOutUnsupported($items));
        }
    }

    /**
     * Add Range Fields to Range object.
     *
     * @param array $range
     *
     * @return self
     */
    public function defineRange($range = [])
    {
        //Define items
        $this->items = $range;
        //Return calling object
        return $this;
    }
}
