<?php

use FindBrok\TradeoffAnalytics\Models;

if (! function_exists('tradeoff_problem')) {
    /**
     * Make a Tradeoff Analytics Problem model.
     *
     * @param array|\stdClass|string $definition
     *
     * @return Models\Problem\Problem;
     */
    function tradeoff_problem($definition)
    {
        return app(Models\Problem\Problem::class)->setData($definition);
    }
}

if (! function_exists('tradeoff_column')) {
    /**
     * Make a Tradeoff Analytics Column model.
     *
     * @param array|\stdClass|string $definition
     *
     * @return Models\Problem\Column
     */
    function tradeoff_column($definition)
    {
        return app(Models\Problem\Column::class)->setData($definition);
    }
}

if (! function_exists('tradeoff_option')) {
    /**
     * Make a Tradeoff Analytics Option model.
     *
     * @param array|\stdClass|string $definition
     *
     * @return Models\Problem\Option
     */
    function tradeoff_option($definition)
    {
        return app(Models\Problem\Option::class)->setData($definition);
    }
}

if (! function_exists('tradeoff_categorical_range')) {
    /**
     * Make a Tradeoff Analytics CategoricalRange model.
     *
     * @param array|\stdClass|string $definition
     *
     * @return Models\Problem\Range\CategoricalRange
     */
    function tradeoff_categorical_range($definition)
    {
        return app(Models\Problem\Range\CategoricalRange::class)->setData($definition);
    }
}

if (! function_exists('tradeoff_date_range')) {
    /**
     * Make a Tradeoff analytics DateRange model.
     *
     * @param array|\stdClass|string $definition
     *
     * @return Models\Problem\Range\DateRange
     */
    function tradeoff_date_range($definition)
    {
        return app(Models\Problem\Range\DateRange::class)->setData($definition);
    }
}

if (! function_exists('tradeoff_value_range')) {
    /**
     * Make a Tradeoff analytics ValueRange model.
     *
     * @param array|\stdClass|string $definition
     *
     * @return Models\Problem\Range\ValueRange
     */
    function tradeoff_value_range($definition)
    {
        return app(Models\Problem\Range\ValueRange::class)->setData($definition);
    }
}

if (! function_exists('tradeoff_dilemma')) {
    /**
     * Make a Tradeoff analytics Dilemma model.
     *
     * @param array|\stdClass|string $definition
     *
     * @return Models\Dilemma
     */
    function tradeoff_dilemma($definition)
    {
        return app(Models\Dilemma::class)->setData($definition);
    }
}

if (! function_exists('tradeoff_resolution')) {
    /**
     * Make a Tradeoff Analytics Resolution model.
     *
     * @param array|\stdClass|string $definition
     *
     * @return Models\Resolution\Resolution
     */
    function tradeoff_resolution($definition)
    {
        return app(Models\Resolution\Resolution::class)->setData($definition);
    }
}

if (! function_exists('tradeoff_solution')) {
    /**
     * Make a Tradeoff Analytics Solution model.
     *
     * @param array|\stdClass|string $definition
     *
     * @return Models\Resolution\Solution
     */
    function tradeoff_solution($definition)
    {
        return app(Models\Resolution\Solution::class)->setData($definition);
    }
}

if (! function_exists('tradeoff_status_cause')) {
    /**
     * Make a Tradeoff Analytic StatusCause model.
     *
     * @param array|\stdClass|string $definition
     *
     * @return Models\Resolution\StatusCause
     */
    function tradeoff_status_cause($definition)
    {
        return app(Models\Resolution\StatusCause::class)->setData($definition);
    }
}

if (! function_exists('tradeoff_excluded_by')) {
    /**
     * Make a Tradeoff Analytic ExcludedBy model.
     *
     * @param array|\stdClass|string $definition
     *
     * @return Models\Resolution\ExcludedBy
     */
    function tradeoff_excluded_by($definition)
    {
        return app(Models\Resolution\ExcludedBy::class)->setData($definition);
    }
}

if (! function_exists('tradeoff_objective')) {
    /**
     * Make a Tradeoff Analytic Objective model.
     *
     * @param array|\stdClass|string $definition
     *
     * @return Models\Resolution\Objective
     */
    function tradeoff_objective($definition)
    {
        return app(Models\Resolution\Objective::class)->setData($definition);
    }
}

if (! function_exists('tradeoff_preferable_solutions')) {
    /**
     * Make a Tradeoff Analytic PreferableSolutions model.
     *
     * @param array|\stdClass|string $definition
     *
     * @return Models\Resolution\PreferableSolutions
     */
    function tradeoff_preferable_solutions($definition)
    {
        return app(Models\Resolution\PreferableSolutions::class)->setData($definition);
    }
}

if (! function_exists('tradeoff_map')) {
    /**
     * Make a Tradeoff Analytics Map model.
     *
     * @param array|\stdClass|string $definition
     *
     * @return Models\Resolution\Map\Map
     */
    function tradeoff_map($definition)
    {
        return app(Models\Resolution\Map\Map::class)->setData($definition);
    }
}

if (! function_exists('tradeoff_map_anchor')) {
    /**
     * Make a Tradeoff Analytics Anchor model.
     *
     * @param array|\stdClass|string $definition
     *
     * @return Models\Resolution\Map\Anchor
     */
    function tradeoff_map_anchor($definition)
    {
        return app(Models\Resolution\Map\Anchor::class)->setData($definition);
    }
}

if (! function_exists('tradeoff_map_node')) {
    /**
     * Make a Tradeoff Analytics Node model.
     *
     * @param array|\stdClass|string $definition
     *
     * @return Models\Resolution\Map\MapNode
     */
    function tradeoff_map_node($definition)
    {
        return app(Models\Resolution\Map\MapNode::class)->setData($definition);
    }
}

if (! function_exists('tradeoff_map_node_coordinates')) {
    /**
     * Make a Tradeoff Analytics MapNodeCoordinates object.
     *
     * @param array|\stdClass|string $definition
     *
     * @return Models\Resolution\Map\MapNodeCoordinates
     */
    function tradeoff_map_node_coordinates($definition)
    {
        return app(Models\Resolution\Map\MapNodeCoordinates::class)->setData($definition);
    }
}
