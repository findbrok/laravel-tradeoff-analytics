<?php

namespace FindBrok\TradeoffAnalytics\Support\DataCollection;

use Illuminate\Support\Collection;

class Resolution extends Collection
{
    /**
     * Find a specific solution.
     *
     * @param string $solutionRef
     *
     * @return Solution
     */
    public function findSolution($solutionRef)
    {
        $solution = $this->hasSolutions() ? $this->objectifySolutions(collect($this->get('solutions'))
            ->where('solution_ref', $solutionRef)
            ->values()
            ->all(), true) : null;

        return ! empty($solution) ? $solution[0] : null;
    }

    /**
     * Get Solutions that shadow the solution specified.
     *
     * @param string $solutionRef
     *
     * @return array|null
     */
    public function getSolutionsShadowing($solutionRef)
    {
        // Find the Solution.
        $solution = $this->findSolution($solutionRef);

        // Solution not found.
        if (is_null($solution)) {
            return null;
        }

        return $this->objectifySolutions(collect($this->get('solutions'))
            ->whereIn('solution_ref', $solution->getShadowMe())
            ->values()
            ->all(), true);
    }

    /**
     * Get Solutions that solutions that are shadowed the solution specified.
     *
     * @param string $solutionRef
     *
     * @return array
     */
    public function getSolutionsBeingShadowedBy($solutionRef)
    {
        // Find the Solution.
        $solution = $this->findSolution($solutionRef);

        // Solution not found.
        if (is_null($solution)) {
            return null;
        }

        return $this->objectifySolutions(collect($this->get('solutions'))
            ->whereIn('solution_ref', $solution->getShadows())
            ->values()
            ->all(), true);
    }

    /**
     * Checks if the Resolution has  Solutions.
     *
     * @return bool
     */
    public function hasSolutions()
    {
        return $this->has('solutions') && ! collect($this->get('solutions'))->isEmpty();
    }

    /**
     * Objectifies the solutions if necessary.
     *
     * @param array $solutions
     * @param bool  $objectify
     *
     * @return array
     */
    public function objectifySolutions($solutions = [], $objectify = false)
    {
        // Transform to objects.
        if ($objectify) {
            return collect($solutions)->transform(function ($item) {
                if (! $item instanceof Solution) {
                    return make_tradeoff_solution($item);
                }

                return $item;
            })->all();
        }

        // Return as array.
        return $solutions;
    }

    /**
     * Filters Solutions based on Status.
     *
     * @param string $status
     *
     * @return array
     */
    public function filterSolutionsByStatus($status = '')
    {
        return collect($this->get('solutions'))->where('status', $status)->values()->all();
    }

    /**
     * Return the Solution objects.
     *
     * @param bool $objectify
     *
     * @return array|null
     */
    public function getAllSolutions($objectify = false)
    {
        return $this->hasSolutions() ? $this->objectifySolutions($this->get('solutions'), $objectify) : null;
    }

    /**
     * Return the solutions that are most favoured.
     *
     * @param bool $objectify
     *
     * @return array|null
     */
    public function getFavouredSolutions($objectify = false)
    {
        return $this->hasSolutions() ? $this->objectifySolutions($this->filterSolutionsByStatus('FRONT'),
            $objectify) : null;
    }

    /**
     * Return the solutions that were excluded.
     *
     * @param bool $objectify
     *
     * @return array|null
     */
    public function getExcludedSolutions($objectify = false)
    {
        return $this->hasSolutions() ? $this->objectifySolutions($this->filterSolutionsByStatus('EXCLUDED'),
            $objectify) : null;
    }

    /**
     * Return Solutions that are marked as incomplete.
     *
     * @param bool|false $objectify
     *
     * @return array|null
     */
    public function getIncompleteSolutions($objectify = false)
    {
        return $this->hasSolutions() ? $this->objectifySolutions($this->filterSolutionsByStatus('INCOMPLETE'),
            $objectify) : null;
    }

    /**
     * Return solutions which options specifies a value for a categorical column that is not included in the column's
     * preferences.
     *
     * @param bool $objectify
     *
     * @return array|null
     */
    public function getUnmetCategoricalPreferenceSolutions($objectify = false)
    {
        return $this->hasSolutions() ? $this->objectifySolutions($this->filterSolutionsByStatus('DOES_NOT_MEET_PREFERENCE'),
            $objectify) : null;
    }

    /**
     * Checks that the Resolution contains a Map.
     *
     * @return bool
     */
    public function hasMap()
    {
        return $this->has('map') && ! collect($this->get('map'))->isEmpty();
    }

    /**
     * Get the Resolution Map object.
     *
     * @return Map|null
     */
    public function getMap()
    {
        return $this->hasMap() ? make_tradeoff_map($this->get('map')) : null;
    }
}
