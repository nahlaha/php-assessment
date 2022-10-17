<?php

namespace App\Exceptions;

use Exception;
use App\Constants\Error;

class BaseException extends Exception
{
    protected int $httpCode;

    public function __construct(int $code, $previous = null)
    {
        $errorCode = Error::from($code);
        $this->code = $code;
        $this->message = !is_null($this->message) ? $this->message : $errorCode->GetErrorMessage();
        $this->httpCode = $errorCode->GetErrorHttpCode();
        parent::__construct($this->message, $this->code, $previous);
    }

    public function getHttpCode()
    {
        return $this->httpCode;
    }
}
