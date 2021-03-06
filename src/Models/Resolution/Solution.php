<?php

namespace FindBrok\TradeoffAnalytics\Models\Resolution;

use FindBrok\TradeoffAnalytics\Models\AbstractModel as Model;

class Solution extends Model
{
    /**
     * The key that uniquely identifies the option in the decision problem.
     *
     * @var string
     */
    protected $solution_ref;

    /**
     * The status of the option for the problem resolution:
     *  - FRONT indicates that the option is included among the best candidates for the problem.
     *  - EXCLUDED indicates that one or more options are strictly better than the option.
     *  - INCOMPLETE indicates that either the option's specification does not include a value for one of the columns or
     *    its value for one of its column values lies outside of the range specified for the column. Only a column whose
     *    is_objective field is true can generate this status.
     *  - DOES_NOT_MEET_PREFERENCE indicates that the option specifies a value for a categorical column
     *    that is not included in the column's preferences.
     *
     * @var string
     */
    protected $status;

    /**
     * If the status of the option is EXCLUDED, a collection of ExcludedBy objects that lists each of the superior
     * options that excluded the current option and describes each value that was strictly better than the current
     * option's value.
     *
     * @var \Illuminate\Support\Collection[ExcludedBy]|null
     */
    protected $excluded_by;

    /**
     * If the status of the option is INCOMPLETE or DOES_NOT_MEET_PREFERENCE, a StatusCause object that provides more
     * information about the cause of the status.
     *
     * @var StatusCause|null
     */
    protected $status_cause;

    /**
     * A list of references to the keys of solutions that are shadowed by this solution.
     *
     * @var array
     */
    protected $shadows;

    /**
     * A list of references to the keys of solutions that shadow this solution.
     *
     * @var array
     */
    protected $shadow_me;

    /**
     * Checks the status of the Solution.
     *
     * @param string $status
     *
     * @return bool
     */
    public function is($status)
    {
        return $this->status === $status;
    }

    /**
     * Checks if the solution is an Optimal one.
     *
     * @return bool
     */
    public function isFront()
    {
        return ! is_null($this->status) && $this->is('FRONT');
    }

    /**
     * Checks if the solution is Incomplete one.
     *
     * @return bool
     */
    public function isIncomplete()
    {
        return ! is_null($this->status) && $this->is('INCOMPLETE');
    }

    /**
     * Checks if the solution is Excluded.
     *
     * @return bool
     */
    public function isExcluded()
    {
        return ! is_null($this->status) && $this->is('EXCLUDED');
    }

    /**
     * Checks if the solution does not meet preference.
     *
     * @return bool
     */
    public function doesNotMeetPreference()
    {
        return ! is_null($this->status) && $this->is('DOES_NOT_MEET_PREFERENCE');
    }

    /**
     * Checks if the Solution has a StatusCause.
     *
     * @return bool
     */
    public function hasStatusCause()
    {
        return ! is_null($this->status_cause) && $this->status_cause instanceof StatusCause;
    }

    /**
     * Checks if Solution is shadowed by other solutions.
     *
     * @return bool
     */
    public function isShadowedByOthers()
    {
        return ! is_null($this->shadow_me) && ! empty($this->shadow_me);
    }

    /**
     * Checks the the solution is shadows other solutions.
     *
     * @return bool
     */
    public function shadowsOthers()
    {
        return ! is_null($this->shadows) && ! empty($this->shadows);
    }
}
