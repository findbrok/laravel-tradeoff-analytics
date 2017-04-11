<?php

namespace FindBrok\TradeoffAnalytics\Exceptions;

use RuntimeException;

class UndefinedBridgeException extends RuntimeException
{
    /**
     * The Exception message.
     *
     * @var string
     */
    protected $message = 'The specified Watson API Bridge does not exist.';
}
