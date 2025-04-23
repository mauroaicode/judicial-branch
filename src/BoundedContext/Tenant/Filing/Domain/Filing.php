<?php

namespace Core\BoundedContext\Tenant\Filing\Domain;

use Core\BoundedContext\Tenant\Filing\Domain\ValueObjects\{
    FilingId,
    FilingCode
};

class Filing
{
    public function __construct(
        private FilingId   $id,
        private FilingCode $code,
    ){
    }

    public static function fromPrimitives(string $id, string $code): Filing
    {
        return new self(
            new FilingId($id),
            new FilingCode($code),
        );
    }

    public function id(): FilingId
    {
        return $this->id;
    }

    public function code(): FilingCode
    {
        return $this->code;
    }
}
