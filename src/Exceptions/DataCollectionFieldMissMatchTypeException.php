<?php

namespace FindBrok\TradeoffAnalytics\Exceptions;

use Exception;
use RuntimeException;

class DataCollectionFieldMissMatchTypeException extends RuntimeException
{
    /**
     * Default error message.
     *
     * @var string
     */
    protected $message = 'Tradeoff Analytics DataCollectionException: Field {%fieldName%} in {%ObjectName%} Object accepts {%type%} only';

    /**
     * DataCollectionFieldMissMatchTypeException constructor.
     *
     * @param string         $field
     * @param int            $objectName
     * @param Exception      $type
     * @param int            $code
     * @param Exception|null $previous
     */
    public function __construct($field, $objectName, $type, $code = 400, Exception $previous = null)
    {
        // Call parent exception.
        parent::__construct($this->constructErrorMessage($field, $objectName, $type), $code, $previous);
    }

    /**
     * Construct error message.
     *
     * @param string $field
     * @param string $object
     * @param string $type
     *
     * @return string
     */
    public function constructErrorMessage($field, $object, $type)
    {
        return str_replace('%ObjectName%', $object,
            str_replace('%fieldName%', $field, str_replace('%type%', $type, $this->message)));
    }
}
