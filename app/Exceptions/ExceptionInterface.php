<?php


namespace App\Exceptions;


interface ExceptionInterface
{

    /**
     * @return mixed
     */
    public function getStatusCode();
}
