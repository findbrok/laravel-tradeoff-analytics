<?php

namespace FindBrok\TradeoffAnalytics\Models\Problem;

use FindBrok\TradeoffAnalytics\Models\AbstractModel as Model;

class Option extends Model
{
    /**
     * An identifier for the option. The key must be
     * unique among all options for the
     * decision problem.
     *
     * @var string
     */
    protected $key;

    /**
     * A map of key-value pairs that specifies a value for each column (objective) of the decision problem in the
     * format "values": { "key1": value1, "key2": value2 }. Value requirements vary by column type; a value must be of
     * the type defined for its column. An option that fails to specify a value for a column for which is_objective is
     * true is marked as INCOMPLETE and is excluded from the resolution.
     *
     * @var \Illuminate\Support\Collection|null
     */
    protected $values;

    /**
     * The name of the option. Used only by the Tradeoff Analytics widget;
     * not part of the problem definition.
     *
     * @var string
     */
    protected $name;

    /**
     * A description of the option in HTML format. The description is displayed when the user selects the option in the
     * interface. Used only by the Tradeoff Analytics widget; not part of the problem definition.
     *
     * @var string
     */
    protected $description_html;

    /**
     * A map of key-value pairs in which the application can pass application-specific information in the format
     * "app_data": { "key1": value1, "key2": value2 }. The service carries the information but does not use it. Used
     * only by the Tradeoff Analytics widget; not part of the problem definition.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $app_data;

    /**
     * Sets values to the model.
     *
     * @param array|null $values
     *
     * @return $this
     */
    public function setValues($values)
    {
        $this->values = collect($values);

        return $this;
    }

    /**
     * Sets app_data to the model.
     *
     * @param array|null $app_data
     *
     * @return $this
     */
    public function setAppData($app_data)
    {
        $this->app_data = collect($app_data);

        return $this;
    }
}
