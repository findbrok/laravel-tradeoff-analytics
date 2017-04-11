<?php

namespace FindBrok\TradeoffAnalytics\Models\Resolution\Map;

use FindBrok\TradeoffAnalytics\Models\AbstractModel as Model;

class MapNodeCoordinates extends Model
{
    /**
     * An X-axis coordinate on the map visualization.
     *
     * @var float
     */
    protected $x;

    /**
     * A Y-axis coordinate on the map visualization.
     *
     * @var float
     */
    protected $y;
}
