<?php

namespace FindBrok\TradeoffAnalytics\Models\Resolution\Map;

use FindBrok\TradeoffAnalytics\Models\AbstractModel as Model;

class Anchor extends Model
{
    /**
     * The name of the anchor point.
     *
     * @var string
     */
    protected $name;

    /**
     * A collection of MapNodeCoordinates object that provides the position
     * of the anchor on the map visualization.
     *
     * @var MapNodeCoordinates|\Illuminate\Support\Collection[MapNodeCoordinates]
     */
    protected $position;

    /**
     * Sets the position to the model.
     *
     * @param array $position
     *
     * @return $this
     */
    public function setPosition($position)
    {
        // We have multiple coordinates
        // so coordinates should be a
        // collection
        if (isset($position[0]) && is_array($position[0])) {
            $this->position = collect($position)->transform(function ($mapCoordinate) {
                return tradeoff_map_node_coordinates($mapCoordinate);
            });
        } else {
            $this->position = tradeoff_map_node_coordinates($position);
        }

        return $this;
    }
}
