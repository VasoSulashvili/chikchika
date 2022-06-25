<?php

namespace App\Exceptions;

use Exception;

class ErrorPageException extends Exception
{
    protected $message;
    protected $code;

    public function __construct($code, $message)
    {
        $this->code = $code;
        $this->message = $message;
    }
}
