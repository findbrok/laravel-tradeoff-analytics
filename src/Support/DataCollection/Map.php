<?php

namespace FindBrok\TradeoffAnalytics\Support\DataCollection;

use Illuminate\Support\Collection;

class Map extends Collection
{
    /**
     * Get all anchor points.
     *
     * @return array
     */
    public function getAnchors()
    {
        return collect($this->get('anchors'))->transform(function ($item) {
            return $item instanceof MapAnchor ? $item : make_tradeoff_map_anchor($item);
        })->all();
    }

    /**
     * Get all nodes.
     *
     * @return array
     */
    public function getNodes()
    {
        return collect($this->get('nodes'))->transform(function ($item) {
            return $item instanceof MapNode ? $item : make_tradeoff_map_node($item);
        })->all();
    }
}
