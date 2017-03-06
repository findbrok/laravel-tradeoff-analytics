<?php

namespace FindBrok\TradeoffAnalytics\Support\DataCollection;

use Illuminate\Support\Collection;

class Dilemma extends Collection
{
    /**
     * Checks if Dilemma has an Initial Problem.
     *
     * @return bool
     */
    public function hasProblem()
    {
        return $this->has('problem') && ! collect($this->get('problem'))->isEmpty();
    }

    /**
     * Get the Initial Problem.
     *
     * @return Problem|null
     */
    public function getProblem()
    {
        // We have the Initial Problem.
        if ($this->hasProblem()) {
            return make_tradeoff_problem($this->get('problem'), true);
        }

        // No Problem found in Dilemma.
        return null;
    }

    /**
     * Checks if the Dilemma has a Resolution.
     *
     * @return bool
     */
    public function hasResolution()
    {
        return $this->has('resolution') && ! collect($this->get('resolution'))->isEmpty();
    }

    /**
     * Return the Resolution object.
     *
     * @return Resolution|null
     */
    public function getResolution()
    {
        return $this->hasResolution() ? make_tradeoff_resolution($this->get('resolution')) : null;
    }
}
