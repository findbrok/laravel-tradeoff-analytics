<?php

namespace FindBrok\TradeoffAnalytics\Support\DataCollection;

use Illuminate\Support\Collection;

/**
 * Class MapAnchor.
 */
class MapAnchor extends Collection
{
    /**
     * Get the coordinates of the Anchor point.
     *
     * @return MapNodeCoordinates
     */
    public function getCoordinates()
    {
        return $this->get('position') instanceof MapNodeCoordinates ?
            $this->get('position') :
            make_tradeoff_map_node_coordinates($this->get('position'));
    }
}
