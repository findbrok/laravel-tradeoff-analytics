<?php

namespace FindBrok\TradeoffAnalytics\Models;

class Problem extends BaseModel
{
    /**
     * An array of Column objects that lists the objectives for the decision problem.
     * The field typically specifies the columns for the tabular
     * representation of the data.
     *
     * @var Column[]
     */
    protected $columns;

    /**
     * An array of Option objects that lists the options for the decision problem.
     * The field typically specifies the rows for the tabular
     * representation of the data.
     *
     * @var Option[]
     */
    protected $options;

    /**
     * A name for the decision problem. The field typically provides a heading
     * for the column that represents the options in the tabular
     * representation of the data.
     *
     * @var string
     */
    protected $subject;

    /**
     * Sets columns to the model.
     *
     * @param Column[] $columns
     *
     * @return $this
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * Sets subject to the model.
     *
     * @param string $subject
     *
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }
}
