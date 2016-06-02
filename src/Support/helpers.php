<?php

if (! function_exists('make_tradeoff_problem')) {
    /**
     * Make a Tradeoff Analytics Problem object
     *
     * @param array $items
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\Problem
     */
    function make_tradeoff_problem($items = [])
    {
        return app()->make('TradeoffAnalyticsProblem', $items);
    }
}

if (! function_exists('make_tradeoff_problem_column')) {
    /**
     * Make a Tradeoff Analytics ProblemColumn object
     *
     * @param array $items
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemColumn
     */
    function make_tradeoff_problem_column($items = [])
    {
        return app()->make('TradeoffAnalyticsProblemColumn', $items);
    }
}

if (! function_exists('make_tradeoff_problem_option')) {
    /**
     * Make a Tradeoff Analytics ProblemOption object
     *
     * @param array $items
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemOption
     */
    function make_tradeoff_problem_option($items = [])
    {
        return app()->make('TradeoffAnalyticsProblemOption', $items);
    }
}

if (! function_exists('make_tradeoff_problem_column_categorical_range')) {
    /**
     * Make a Tradeoff Analytics ProblemColumnCategoricalRange object
     *
     * @param array $items
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemColumnCategoricalRange
     */
    function make_tradeoff_problem_column_categorical_range($items = [])
    {
        return app()->make('TradeoffAnalyticsProblemColumnCategoricalRange', $items);
    }
}

if (! function_exists('make_tradeoff_problem_column_date_range')) {
    /**
     * Make a Tradeoff analytics ProblemColumnDateRange object
     *
     * @param array $items
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemColumnDateRange
     */
    function make_tradeoff_problem_column_date_range($items = [])
    {
        return app()->make('TradeoffAnalyticsProblemColumnDateRange', $items);
    }
}

if (! function_exists('make_tradeoff_problem_column_value_range')) {
    /**
     * Make a Tradeoff analytics ProblemColumnValueRange object
     *
     * @param array $items
     * @return \FindBrok\TradeoffAnalytics\Support\DataCollection\ProblemColumnValueRange
     */
    function make_tradeoff_problem_column_value_range($items = [])
    {
        return app()->make('TradeoffAnalyticsProblemColumnValueRange', $items);
    }
}
