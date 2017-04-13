<?php

namespace FindBrok\TradeoffAnalytics\Models;

use FindBrok\TradeoffAnalytics\Concerns;
use FindBrok\TradeoffAnalytics\Models\Problem\Problem;
use FindBrok\TradeoffAnalytics\Models\Resolution\Resolution;
use FindBrok\TradeoffAnalytics\Models\AbstractModel as Model;

class Dilemma extends Model
{
    use Concerns\Resolvable,
        Concerns\Bridgeable;

    /**
     * The Problem object that was submitted in the
     * call to the dilemmas method.
     *
     * @var \FindBrok\TradeoffAnalytics\Models\Problem\Problem
     */
    protected $problem;

    /**
     * A Resolution object that provides the resolution of
     * the decision problem.
     *
     * @var \FindBrok\TradeoffAnalytics\Models\Resolution\Resolution
     */
    protected $resolution;

    /**
     * Checks if Dilemma has Problem loaded.
     *
     * @return bool
     */
    public function hasProblem()
    {
        return (! is_null($this->problem) && $this->problem instanceof Problem);
    }

    /**
     * Checks if Dilemma has a resolution.
     *
     * @return bool
     */
    public function hasResolution()
    {
        return (! is_null($this->resolution) && $this->resolution instanceof Resolution);
    }
}
