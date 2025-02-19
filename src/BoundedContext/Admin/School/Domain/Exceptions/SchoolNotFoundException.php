<?php

namespace Core\BoundedContext\Admin\School\Domain\Exceptions;

use Core\Shared\Domain\Exceptions\DomainException;
use Throwable;

class SchoolNotFoundException extends DomainException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null) {
        $message = "" === $message ? "La escuela de conducción no existe" : $message;

        parent::__construct($message, $code, $previous);
    }
}
