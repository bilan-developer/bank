<?php

namespace App\Exceptions;

use App\Http\Core\Constants;
use Exception;

class BaseException extends Exception implements ExceptionInterface
{

    protected $code = Constants::INTERNAL_SERVER_ERROR;

    protected $message = 'Error';

    /**
     * Exception constructor.
     *
     * @param null $message
     * @param null $code
     */
    public function __construct($message = null, $code = null)
    {
        if($message){
            $this->message = $message;
        }

        if($code){
            $this->code = $code;
        }
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->code;
    }
}
