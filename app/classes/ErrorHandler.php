<?php

class ErrorHandler
{
    public $errors;
    
    public function addError($error, $key)
    {
        $this->errors[$key][] = $error;
    }
}