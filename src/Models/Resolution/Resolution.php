<?php

namespace FindBrok\TradeoffAnalytics\Models\Resolution;

use Illuminate\Support\Collection;
use FindBrok\TradeoffAnalytics\Models\Resolution\Map\Map;
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
     * Checks if the Resolution Object has a Map.
     *
     * @return bool
     */
    public function hasMap()
    {
        return ! is_null($this->map) && $this->map instanceof Map;
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
        $solutionKey = $this->solutions->search(function (Solution $item) use ($solutionRef) {
            return $item->solution_ref == $solutionRef;
        });

        // Return the Solution.
        return $solutionKey !== false ? $this->solutions[$solutionKey] : null;
    }

    /**
     * Get all solutions with the specified status.
     *
     * @param string $status
     *
     * @return Collection|null
     */
    public function getSolutionsByStatus($status)
    {
        // No Solutions.
        if ($this->hasNoSolutions()) {
            return null;
        }

        // Capitalize status word.
        $status = strtoupper($status);

        // Filter solutions and return.
        $expectedSolutions = $this->solutions->reject(function (Solution $item) use ($status) {
            return $item->status != $status;
        });

        // Return solutions.
        return $expectedSolutions->isNotEmpty() ? $expectedSolutions->values() : null;
    }

    /**
     * Find all solutions shadowing the specific
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

        // Nothing found or no solutions is currently shadowing
        // the current solution.
        if (is_null($solution) || ! $solution->isShadowedByOthers()) {
            return null;
        }

        // Return solutions.
        return $this->makeSolutionRefsArrayToSolutions($solution->shadow_me);
    }

    /**
     * Find all solutions being shadowed by the given solution ref.
     *
     * @param mixed $solutionRef
     *
     * @return Collection|null
     */
    public function findSolutionsBeingShadowedBy($solutionRef)
    {
        // Get the current solution.
        $solution = $this->findSolution($solutionRef);

        // Nothing found or no solutions being shadowed by the
        // current solution.
        if (is_null($solution) || ! $solution->shadowsOthers()) {
            return null;
        }

        // Return solutions
        return $this->makeSolutionRefsArrayToSolutions($solution->shadows);
    }

    /**
     * Return all solutions that are favored or marked as "FRONT".
     *
     * @return Collection|null
     */
    public function getFavoredSolutions()
    {
        return $this->getSolutionsByStatus('FRONT');
    }

    /**
     * Return all solutions that were marked as "EXCLUDED".
     *
     * @return Collection|null
     */
    public function getExcludedSolutions()
    {
        return $this->getSolutionsByStatus('EXCLUDED');
    }

    /**
     * Return all solutions that are marked as "EXCLUDED".
     *
     * @return Collection|null
     */
    public function getIncompleteSolutions()
    {
        return $this->getSolutionsByStatus('INCOMPLETE');
    }

    /**
     * Return all solutions that are marked as "DOES_NOT_MEET_PREFERENCE".
     *
     * @return Collection|null
     */
    public function getUnmetPreferenceSolutions()
    {
        return $this->getSolutionsByStatus('DOES_NOT_MEET_PREFERENCE');
    }

    /**
     * Takes an array of Solution ref and makes it into the Solution
     * object.
     *
     * @param array $solutionsRefs
     *
     * @return Collection
     */
    protected function makeSolutionRefsArrayToSolutions(array $solutionsRefs)
    {
        return collect($solutionsRefs)->transform(function ($solutionRef) {
            // Transform to a SolutionObject.
            return $this->findSolution($solutionRef);
        })->reject(function ($item) {
            // Remove NULL items from list.
            return is_null($item);
        })->values();
    }
}
