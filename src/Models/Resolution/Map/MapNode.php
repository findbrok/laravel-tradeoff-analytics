<?php

namespace FindBrok\TradeoffAnalytics\Models\Resolution\Map;

use FindBrok\TradeoffAnalytics\Models\AbstractModel as Model;

class MapNode extends Model
{
    /**
     * A collection of MapNodeCoordinates objects that provides the positions of a cell on the map visualization.
     *
     * @var MapNodeCoordinates|\Illuminate\Support\Collection[MapNodeCoordinates]
     */
    protected $coordinates;

    /**
     * References to solutions (the keys for options) that are positioned on this cell.
     *
     * @var array
     */
    protected $solution_refs;

    /**
     * Sets coordinates to the model.
     *
     * @param array $coordinates
     *
     * @return $this
     */
    protected function setCoordinates($coordinates)
    {
        // We have multiple coordinates
        // so coordinates should be a
        // collection
        if (isset($coordinates[0]) && is_array($coordinates[0])) {
            $this->coordinates = collect($coordinates)->transform(function ($mapCoordinate) {
                return tradeoff_map_node_coordinates($mapCoordinate);
            });
        } else {
            $this->coordinates = tradeoff_map_node_coordinates($coordinates);
        }

        return $this;
    }
}
