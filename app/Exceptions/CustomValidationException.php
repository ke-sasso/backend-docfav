<?php

namespace App\Exceptions;

use Exception;

class CustomValidationException extends Exception
{
    public $errorList;

    public function __construct($errorList)
    {
        $this->errorList = $errorList;

        parent::__construct();
    }
}