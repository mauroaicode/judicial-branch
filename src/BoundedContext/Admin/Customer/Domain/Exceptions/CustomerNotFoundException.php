<?php

namespace Core\BoundedContext\Admin\Customer\Domain\Exceptions;

use Core\Shared\Domain\Exceptions\DomainException;
use Throwable;

class CustomerNotFoundException extends DomainException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null) {
        $message = "" === $message ? "El cliente no existe" : $message;

        parent::__construct($message, $code, $previous);
    }
}
