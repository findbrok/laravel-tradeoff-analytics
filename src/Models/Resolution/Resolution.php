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
        return
            ! is_null($this->solutions) &&
            $this->solutions instanceof Collection &&
            $this->solutions->isNotEmpty();
    }

    /**
     * Checks if the Resolution Object has any
     * solutions.
     *
     * @return bool
     */
    public function hasNoSolutions()
    {
        return ! $this->hasSolutions();
    }

    /**
     * Find a specific solution in the Resolution.
     *
     * @param mixed $solutionRef
     *
     * @return Solution|null
     */
    public function findSolution($solutionRef)
    {
        // No Solutions
        if ($this->hasNoSolutions()) {
            return null;
        }

        // Search for the solution key.
        $solutionKey = $this->solutions->search(function ($item) use ($solutionRef) {
            return $item->solution_ref == $solutionRef;
        });

        // Return the Solution.
        return $solutionKey !== false ? $this->solutions[$solutionKey] : null;
    }

    /**
     * Find all Solutions shadowing the specific
     * solution.
     *
     * @param mixed $solutionRef
     *
     * @return Collection|null
     */
    public function findSolutionsShadowing($solutionRef)
    {
        // Get the current solution.
        $solution = $this->findSolution($solutionRef);

        // Nothing found.
        if (is_null($solution)) {
            return null;
        }

        // No solutions is currently shadowing
        // the current solution.
        if (! $solution->isShadowedByOthers()) {
            return null;
        }

        // Get Solutions shadowing the current solution.
        $shadowingSolutions = $solution->shadow_me;

        // Return solutions.
        return collect($shadowingSolutions)->transform(function ($solutionRef) {
            return $this->findSolution($solutionRef);
        })->reject(function ($item) {
            return is_null($item);
        });
    }
}
