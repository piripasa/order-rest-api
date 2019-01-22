<?php namespace App\Exceptions;

class GenericException extends BaseException
{
    public function __construct ($message = "Something went wrong") {
        parent::__construct($message, 400);
    }
}