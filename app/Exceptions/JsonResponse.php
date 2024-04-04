<?php

namespace App\Exceptions;

use Exception;

class JsonResponse extends Exception
{
    private $data;

    public function __construct($data, $code = 0, $message = null, $previous = null)
    {
        $this->data = $data;
        parent::__construct($message, $code, $previous);
    }

    public function getData()
    {
        return $this->data;
    }
}
