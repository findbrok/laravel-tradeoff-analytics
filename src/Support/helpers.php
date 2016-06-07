<?php

if (! function_exists('make_tradeoff_problem')) {
    /**
     * Make a Tradeoff Analytics Problem object
     *
     * @param array $items
     * @param bool $objectify
     *
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\Problem
     */
    function make_tradeoff_problem($items = [], $objectify = false)
    {
        $problem = app()->make('TradeoffProblem', $items);

        if ($objectify) {
            return $problem->objectify();
        }
        
        return $problem;
    }
}

if (! function_exists('make_tradeoff_problem_column')) {
    /**
     * Make a Tradeoff Analytics ProblemColumn object
     *
     * @param array $items
     *
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemColumn
     */
    function make_tradeoff_problem_column($items = [])
    {
        return app()->make('TradeoffProblemColumn', $items);
    }
}

if (! function_exists('make_tradeoff_problem_option')) {
    /**
     * Make a Tradeoff Analytics ProblemOption object
     *
     * @param array $items
     *
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemOption
     */
    function make_tradeoff_problem_option($items = [])
    {
        return app()->make('TradeoffProblemOption', $items);
    }
}

if (! function_exists('make_tradeoff_problem_column_categorical_range')) {
    /**
     * Make a Tradeoff Analytics ProblemColumnCategoricalRange object
     *
     * @param array $items
     *
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemColumnCategoricalRange
     */
    function make_tradeoff_problem_column_categorical_range($items = [])
    {
        return app()->make('TradeoffProblemColumnCategoricalRange', $items);
    }
}

if (! function_exists('make_tradeoff_problem_column_date_range')) {
    /**
     * Make a Tradeoff analytics ProblemColumnDateRange object
     *
     * @param array $items
     *
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemColumnDateRange
     */
    function make_tradeoff_problem_column_date_range($items = [])
    {
        return app()->make('TradeoffProblemColumnDateRange', $items);
    }
}

if (! function_exists('make_tradeoff_problem_column_value_range')) {
    /**
     * Make a Tradeoff analytics ProblemColumnValueRange object
     *
     * @param array $items
     *
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemColumnValueRange
     */
    function make_tradeoff_problem_column_value_range($items = [])
    {
        return app()->make('TradeoffProblemColumnValueRange', $items);
    }
}

if (! function_exists('make_tradeoff_dilemma')) {
    /**
     * Make a Tradeoff analytics Dilemma Object
     *
     * @param array $items
     *
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\Dilemma
     */
    function make_tradeoff_dilemma($items = [])
    {
        return app()->make('TradeoffDilemma', $items);
    }
}

if (! function_exists('make_tradeoff_resolution')) {
    /**
     * Make a Tradeoff Analytics Resolution Object
     *
     * @param array $items
     *
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\Resolution
     */
    function make_tradeoff_resolution($items = [])
    {
        return app()->make('TradeoffResolution', $items);
    }
}

if (! function_exists('make_tradeoff_solution')) {
    /**
     * Make a Tradeoff Analytics Solution Object
     *
     * @param array $items
     *
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\Solution
     */
    function make_tradeoff_solution($items = [])
    {
        return app()->make('TradeoffSolution', $items);
    }
}

if (! function_exists('make_tradeoff_solution_status_cause')) {
    /**
     * Make a Tradeoff Analytic SolutionStatusCause Object
     *
     * @param array $item
     *
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\SolutionStatusCause
     */
    function make_tradeoff_solution_status_cause($item = [])
    {
        return app()->make('TradeoffSolutionStatusCause', $item);
    }
}

if (! function_exists('make_tradeoff_map')) {
    /**
     * Make a Tradeoff Analytics Map Object
     *
     * @param array $items
     *
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\Map
     */
    function make_tradeoff_map($items = [])
    {
        return app()->make('TradeoffMap', $items);
    }
}

if (! function_exists('make_tradeoff_map_anchor')) {
    /**
     * Make a Tradeoff Analytics MapAnchor object
     *
     * @param array $items
     *
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\MapAnchor
     */
    function make_tradeoff_map_anchor($items = [])
    {
        return app()->make('TradeoffMapAnchor', $items);
    }
}

if (! function_exists('make_tradeoff_map_node')) {
    /**
     * Make a Tradeoff Analytics MapNode object
     *
     * @param array $items
     *
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\MapNode
     */
    function make_tradeoff_map_node($items = [])
    {
        return app()->make('TradeoffMapNode', $items);
    }
}

if (! function_exists('make_tradeoff_map_node_coordinates')) {
    /**
     * Make a Tradeoff Analytics MapNodeCoordinates object
     *
     * @param array $items
     *
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\MapNodeCoordinates
     */
    function make_tradeoff_map_node_coordinates($items = [])
    {
        return app()->make('TradeoffMapNodeCoordinates', $items);
    }
}
