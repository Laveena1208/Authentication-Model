<?php

class ErrorHandler
{
    public $errors = [];
    
    public function addError($error, $key)
    {
        $this->errors[$key][] = $error;
    }

    public function hasErrors() :bool
    {
        return count($this->errors) > 0;
    }

    public function has(string $key): bool
    {
        return isset($this->errors[$key]);
    }

    public function first(string $key): string|null
    {
        if($this->has($key))
        {
            return $this->errors[$key][0];
        }
        return null;
        //return $this->errors[$key][0] ?? null;
        // ?? this is from php 8 description k liye lec 9
    }

    public function all(string|null $key = null): array|null
    {
        if($key == null)
        {
            return $this->errors;
        }
        return $this->errors[$key] ?? null;
    }
}