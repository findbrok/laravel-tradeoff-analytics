<?php

namespace FindBrok\TradeoffAnalytics\Models\Resolution;

use Illuminate\Support\Collection;
use FindBrok\TradeoffAnalytics\Models\AbstractModel as Model;

class Resolution extends Model
{
    /**
     * An collection of Solution objects that contains the analytical data prepared by the service for each option of
     * the decision problem.
     *
     * @var \Illuminate\Support\Collection[Solution]
     */
    protected $solutions;

    /**
     * A PreferableSolutions object that identifies the preferred solutions from among the best candidates of the
     * decision problem. The resolution includes this field only if the find_preferable_options parameter is true.
     *
     * @var PreferableSolutions|null
     */
    protected $preferable_solutions;

    /**
     * A Map object that provides the two-dimensional positioning of each option on the map polygon displayed by the
     * Tradeoff Analytics visualization. The resolution includes this field only if the generate_visualization
     * parameter is true, the is_objective field is true for at least three columns in the call to the dilemmas method,
     * and at least three options have a status of FRONT in the problem resolution.
     *
     * @var \FindBrok\TradeoffAnalytics\Models\Resolution\Map\Map
     */
    protected $map;

    /**
     * Checks if Resolution has solutions.
     *
     * @return bool
     */
    public function hasSolutions()
    {
        return (
            ! is_null($this->solutions) &&
            $this->solutions instanceof Collection &&
            $this->solutions->isNotEmpty()
        );
    }
}
