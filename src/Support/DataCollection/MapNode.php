<?php

namespace FindBrok\TradeoffAnalytics\Support\DataCollection;

use Illuminate\Support\Collection;

/**
 * Class MapNode.
 */
class MapNode extends Collection
{
    /**
     * Get the coordinates of the Node point.
     *
     * @return MapNodeCoordinates
     */
    public function getCoordinates()
    {
        return $this->get('coordinates') instanceof MapNodeCoordinates ?
            $this->get('coordinates') :
            make_tradeoff_map_node_coordinates($this->get('coordinates'));
    }
}
