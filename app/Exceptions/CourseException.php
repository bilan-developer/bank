<?php

namespace App\Exceptions;

use App\Http\Core\Constants;

class CourseException extends BaseException
{

    protected $code = Constants::INTERNAL_SERVER_ERROR;

    protected $message = 'An error occurred while getting the current course.';


    /**
     * ApiCRMException constructor.
     * @param null $message
     * @param null $errors
     * @param null $code
     */
    public function __construct($message = null, $errors = null, $code = null)
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
