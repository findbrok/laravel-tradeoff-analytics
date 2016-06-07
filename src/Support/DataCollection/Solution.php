<?php

namespace FindBrok\TradeoffAnalytics\Support\DataCollection;

use Illuminate\Support\Collection;

/**
 * Class Solution.
 */
class Solution extends Collection
{
    /**
     * Check is the solution is an Optimal one.
     *
     * @return bool
     */
    public function isFavoured()
    {
        return $this->get('status') == 'FRONT';
    }

    /**
     * Checks if the solution is Incomplete.
     *
     * @return bool
     */
    public function isIncomplete()
    {
        return $this->get('status') == 'INCOMPLETE';
    }

    /**
     * Checks if the solution is Excluded.
     *
     * @return bool
     */
    public function isExcluded()
    {
        return $this->get('status') == 'EXCLUDED';
    }

    /**
     * Checks if the solution does not meet preference.
     *
     * @return bool
     */
    public function doesNotMeetPreference()
    {
        return $this->get('status') == 'DOES_NOT_MEET_PREFERENCE';
    }

    /**
     * Checks that the solution is shadowed by other solutions.
     *
     * @return bool
     */
    public function isShadowedByOthers()
    {
        return $this->has('shadow_me') && ! collect($this->get('shadow_me'))->isEmpty();
    }

    /**
     * Checks the the solution is shadows other solutions.
     *
     * @return bool
     */
    public function shadowsOthers()
    {
        return $this->has('shadows') && ! collect($this->get('shadows'))->isEmpty();
    }

    /**
     * Array of solution that shadow this solution.
     *
     * @return array
     */
    public function getShadowMe()
    {
        return $this->get('shadow_me', []);
    }

    /**
     * Array of solutions that gets shadowed by this solution.
     *
     * @return array
     */
    public function getShadows()
    {
        return $this->get('shadows', []);
    }

    /**
     * Checks if the Solution has a StatusCause.
     *
     * @return bool
     */
    public function hasStatusCause()
    {
        return $this->has('status_cause') && ! collect($this->get('status_cause'))->isEmpty();
    }

    /**
     * Returns the StatusCause object.
     *
     * @return SolutionStatusCause|null
     */
    public function getStatusCause()
    {
        return $this->hasStatusCause() ? make_tradeoff_solution_status_cause($this->get('status_cause')) : null;
    }
}
