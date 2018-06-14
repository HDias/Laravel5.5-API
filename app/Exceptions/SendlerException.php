<?php

namespace Sendler\Exceptions;

class SendlerException extends \Exception implements ExceptionInterface
{
    public function getStatusCode()
    {
        return $this->getCode();
    }
}