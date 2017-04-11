<?php

namespace FindBrok\TradeoffAnalytics\Concerns;

trait Resolvable
{
    /**
     * Indicates whether to calculate the map visualization for the results. If true (the default), the visualization
     * is returned if the is_objective field is true for at least three columns and at least three options have a
     * status of FRONT in the problem resolution.
     *
     * @var bool
     */
    protected $generate_visualization = false;

    /**
     * Indicates whether the service is to identify preferable solutions from the set of best candidates that it
     * selects. If false (the default), no preferable solutions are identified.
     *
     * @var bool
     */
    protected $find_preferable_options = false;

    /**
     * Sets generate_visualization.
     *
     * @param bool $generate_visualization
     *
     * @return $this
     */
    public function setGenerateVisualization($generate_visualization)
    {
        $this->generate_visualization = $generate_visualization;

        return $this;
    }

    /**
     * Sets find_preferable_options.
     *
     * @param $find_preferable_options
     *
     * @return $this
     */
    public function setFindPreferableOptions($find_preferable_options)
    {
        $this->find_preferable_options = $find_preferable_options;

        return $this;
    }

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

    /**
     * Resolve the Dilemma.
     *
     * @return $this
     */
    public function resolve()
    {
        // Get Endpoint.
        $endpoint = $this->constructEndPoint();

        // Get Response from Watson.
        $response = $this->getBridge()->post($endpoint, []);
    }

    /**
     * Construct the API Endpoint.
     *
     * @return string
     */
    protected function constructEndPoint()
    {
        // Start of the EndPoint.
        $startWith = '/'.config('tradeoff-analytics.api_version').'/dilemmas';

        // Make query string params.
        $queryString = collect([
            'find_preferable_options' => $this->find_preferable_options,
            'generate_visualization'  => $this->generate_visualization,
        ])->transform(function ($item, $key) {
            return $key.'='.var_export($item, true);
        })->values()->implode('&');

        return $startWith.'?'.$queryString;
    }
}
