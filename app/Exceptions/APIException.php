<?php

namespace API\Exceptions;

class APIException extends \Exception implements ExceptionInterface
{
    public function getStatusCode()
    {
        return $this->getCode();
    }
}