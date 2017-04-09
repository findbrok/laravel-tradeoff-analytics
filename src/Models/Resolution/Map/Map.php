<?php

namespace FindBrok\TradeoffAnalytics\Models\Resolution\Map;

use FindBrok\TradeoffAnalytics\Models\AbstractModel as Model;

class Map extends Model
{
    /**
     * A collection of Anchor objects that represent the vertices for the objectives and their positions on the map
     * visualization.
     *
     * @var \Illuminate\Support\Collection[Anchor]|null
     */
    protected $anchors;

    /**
     * A collection of MapNode objects for the cells on the map visualization. Each cell in the array includes
     * coordinates that describe the position on the map of the glyphs for one or more listed options, which are
     * identified by their keys. The structure of an array element is
     * {"coordinates": {"x": 0, "y": 0}, "solution_refs": ["key1", "key3"]},
     * where coordinates describe the position on the map visualization of options identified by the keys in
     * solution_refs.
     *
     * @var \Illuminate\Support\Collection[MapNode]|null
     */
    protected $nodes;
}
