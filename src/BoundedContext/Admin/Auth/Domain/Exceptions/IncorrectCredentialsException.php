<?php

namespace Core\BoundedContext\Admin\Auth\Domain\Exceptions;

use Throwable;
use Core\Shared\Domain\Exceptions\DomainException;

final class IncorrectCredentialsException extends DomainException {
    public function __construct($message = "", $code = 0, Throwable $previous = null) {
        $message = "" === $message ? "Credenciales de acceso incorrectas" : $message;

        parent::__construct($message, $code, $previous);
    }
}
