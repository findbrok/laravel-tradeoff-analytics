<?php

namespace FindBrok\TradeoffAnalytics\Support\DataCollection;

use FindBrok\TradeoffAnalytics\Exceptions\DataCollectionFieldMissMatchTypeException;

/**
 * Class Problem
 *
 * @package FindBrok\TradeoffAnalytics\Support\DataCollection
 */
class Problem extends BaseCollector
{
    /**
     * List of Supported Field Names
     *
     * @var array
     */
    protected $supportedFields = [
        /*
        |--------------------------------------------------------------------------
        | Subject (String | Required)
        |--------------------------------------------------------------------------
        | 
        | A name for the decision problem. The field typically provides a heading
        | for the column that represents the options in the tabular
        | representation of the data.
        |
        */

        'subject',

        /*
        |--------------------------------------------------------------------------
        | Columns (Object | Required)
        |--------------------------------------------------------------------------
        |
        | An array of ProblemColumn objects that lists the objectives for the
        | decision problem. The field typically specifies the columns
        | for the tabular representation of the data.
        |
        */

        'columns',

        /*
        |--------------------------------------------------------------------------
        | Options (Object | Required)
        |--------------------------------------------------------------------------
        | 
        | An array of ProblemOption objects that lists the options for the
        | decision problem. The field typically specifies the rows for
        | the tabular representation of the data
        |
        */

        'options'
    ];

    /**
     * Perform a check to see if item is a ProblemColumn object
     *
     * @param mixed $item
     * @throws DataCollectionFieldMissMatchTypeException
     * @return void
     */
    protected function validateColumnField($item)
    {
        if (! $item instanceof ProblemColumn) {
            throw new DataCollectionFieldMissMatchTypeException('columns', 'Problem', 'ProblemColumn');
        }
    }

    /**
     * Perform a check to see if item is a ProblemOption object
     *
     * @param mixed $item
     * @throws DataCollectionFieldMissMatchTypeException
     * @return void
     */
    protected function validateOptionField($item)
    {
        if (! $item instanceof ProblemOption) {
            throw new DataCollectionFieldMissMatchTypeException('options', 'Problem', 'ProblemOption');
        }
    }

    /**
     * Add Columns to the Problem
     *
     * @param ProblemColumn|array $items
     * @return self
     */
    public function addColumns($items)
    {
        //Force Array
        $items = $items instanceof ProblemColumn ? [$items] : $items;
        //Validate items
        collect($items)->each(function ($item) {
            $this->validateColumnField($item);
        });
        //Add columns
        $this->put('columns', collect($this->get('columns'))->merge($items)->all());
        //Return Problem
        return $this;
    }

    /**
     * Add Options to a Problem
     *
     * @param ProblemOption|array $items
     * @return self
     */
    public function addOptions($items)
    {
        //Force array
        $items = $items instanceof ProblemOption ? [$items] : $items;
        //Validate items
        collect($items)->each(function ($item) {
            $this->validateOptionField($item);
        });
        //Add option
        $this->put('options', collect($this->get('options'))->merge($items)->all());
        //Return Problem
        return $this;
    }

    /**
     * Get the statement of the problem to send to Watson
     *
     * @return array
     */
    public function statement()
    {
        return $this->transform(function ($item) {
            if (is_array($item)) {
                return collect($item)->toArray();
            }
            return $item;
        })->toArray();
    }
}
