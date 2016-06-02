<?php

namespace FindBrok\TradeoffAnalytics\Support\DataCollection;

use FindBrok\TradeoffAnalytics\Exceptions\DataCollectionUnsupportedFieldException;
use Illuminate\Support\Collection;

/**
 * Class BaseCollector
 *
 * @package FindBrok\TradeoffAnalytics\Support\DataCollection
 */
class BaseCollector extends Collection
{
    /**
     * Create a new Problem.
     *
     * @param  mixed  $items
     */
    public function __construct($items = [])
    {
        parent::__construct($this->filterOutUnsupported($items));
    }

    /**
     * Check if we have a property for supported fields
     *
     * @return bool
     */
    public function hasSupportedFields()
    {
        return property_exists($this, 'supportedFields') && ! empty($this->supportedFields);
    }

    /**
     * Check if a field is supported
     *
     * @param $field
     * @return bool
     */
    public function isFieldSupported($field)
    {
        return $this->hasSupportedFields() && in_array($field, $this->supportedFields);
    }

    /**
     * Return supported fields only
     *
     * @param array $items
     * @return array
     */
    public function filterOutUnsupported($items = [])
    {
        return collect($items)->reject(function ($item, $key) {
            return ($this->hasSupportedFields() && ! in_array($key, $this->supportedFields));
        })->all();
    }

    /**
     * Put an item in the collection by key.
     *
     * @param  mixed  $key
     * @param  mixed  $value
     * @throws DataCollectionUnsupportedFieldException
     * @return $this
     */
    public function put($key, $value)
    {
        //Field not supported
        if (! $this->isFieldSupported($key)) {
            throw new DataCollectionUnsupportedFieldException($key, get_class($this));
        }
        //Parent Put
        return parent::put($key, $value);
    }

    /**
     * Merge the collection with the given items.
     *
     * @param  mixed  $items
     * @return static
     */
    public function merge($items)
    {
        //Parent merge
        return parent::merge($this->filterOutUnsupported($items));
    }

    /**
     * Add items to the Column
     *
     * @param array $items
     * @return self
     */
    public function add($items = [])
    {
        //Column not empty
        if(! $this->isEmpty()) {
            $this->items = $this->merge($items)->all();
            return $this;
        }
        //Override items
        $this->items = $items;
        return $this;
    }
}
