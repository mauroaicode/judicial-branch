<?php

namespace Core\BoundedContext\Tenant\Filing\Application\Responses;

use Core\BoundedContext\Tenant\Filing\Domain\Filing;

final class FilingResponse
{

    public function __construct(private string $id, private string $code){}

    public static function fromFiling(Filing $filing): self
    {
        return new self(
            $filing->id()->value(),
            $filing->code()->value(),
        );
    }

    public function id(): string
    {
        return $this->id;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
        ];
    }
}
