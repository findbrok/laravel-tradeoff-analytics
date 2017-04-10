<?php

namespace FindBrok\TradeoffAnalytics\Concerns;

trait Resolvable
{
    /**
     * Load a Problem to the model.
     *
     * @param array|string|\stdClass $definition
     *
     * @return $this
     */
    public function loadProblem($definition)
    {
        // Create the Problem object.
        $problem = tradeoff_problem($definition);

        // Set it to the Model.
        $this->problem = $problem;

        return $this;
    }

    public function resolve()
    {
    }
}
