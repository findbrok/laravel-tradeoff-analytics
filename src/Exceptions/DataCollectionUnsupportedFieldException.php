<?php

namespace FindBrok\TradeoffAnalytics\Exceptions;

use Exception;
use RuntimeException;

/**
 * Class DataCollectionUnsupportedFieldException.
 */
class DataCollectionUnsupportedFieldException extends RuntimeException
{
    /**
     * Default error message.
     *
     * @var string
     */
    protected $message = 'Tradeoff Analytics DataCollectionException: Unsupported field {%fieldName%} in {%ObjectName%} Object';

    /**
     * Create a new instance of UnsupportedProblemFieldException.
     *
     * @param string         $field
     * @param string         $objectName
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct($field, $objectName, $code = 400, Exception $previous = null)
    {
        //Call parent exception
        parent::__construct($this->constructErrorMessage($field, $objectName), $code, $previous);
    }

    /**
     * Construct error message.
     *
     * @param string $field
     * @param string $object
     *
     * @return string
     */
    public function constructErrorMessage($field, $object)
    {
        return str_replace('%ObjectName%', $object, str_replace('%fieldName%', $field, $this->message));
    }
}
