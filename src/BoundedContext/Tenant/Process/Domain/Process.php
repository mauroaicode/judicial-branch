<?php

namespace Core\BoundedContext\Tenant\Process\Domain;

use Core\BoundedContext\Tenant\Process\Domain\ValueObjects\{Grouped\ProcessData,
    ProcessId
};


class Process
{
    public function __construct(
        private ProcessId   $id,
        private ProcessData $data
    ){
    }

    public static function fromPrimitives(string $id, ProcessData $data): self
    {
        return new self(
            new ProcessId($id),
            $data
        );
    }

    public static function create(ProcessId $id, ProcessData $data): self
    {
        return new self(
            $id,
            $data
        );
    }

    public function id(): ProcessId
    {
        return $this->id;
    }

    public function data(): ProcessData
    {
        return $this->data;
    }

    public function toArray(): array
    {
        return array_merge([
            'id' => $this->id->value(),
        ], $this->data->toArray());
    }
}
