<?php

namespace App\Exceptions;

use Exception;

class ErrorException extends Exception
{
    /**
     * @var string
     */
    protected $message = '';
    protected $data = '';

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }
}
