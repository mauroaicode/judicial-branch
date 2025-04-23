<?php

namespace Core\BoundedContext\Tenant\Process\Domain\ValueObjects\Grouped;

class ProcessData
{
    public function __construct(
        public int     $processId,
        public string     $filingId,
        public string  $filingCode,
        public int     $connectionId,
        public bool    $isPrivate,
        public ?string $processDate,
        public ?string $court,
        public ?string $judge,
        public ?string $processType,
        public ?string $processClass,
        public ?string $processSubclass,
        public ?string $appealType,
        public ?string $location,
        public ?string $filingContent,
        public ?string $consultedAt,
        public ?string $lastUpdatedAt,
    ){
    }

    public function toArray(): array
    {
        return [
            'process_id' => $this->processId,
            'filing_id' => $this->filingId,
            'filing_code' => $this->filingCode,
            'connection_id' => $this->connectionId,
            'is_private' => $this->isPrivate,
            'process_date' => $this->processDate,
            'court' => $this->court,
            'judge' => $this->judge,
            'process_type' => $this->processType,
            'process_class' => $this->processClass,
            'process_subclass' => $this->processSubclass,
            'appeal_type' => $this->appealType,
            'location' => $this->location,
            'filing_content' => $this->filingContent,
            'consulted_at' => $this->consultedAt,
            'last_updated_at' => $this->lastUpdatedAt,
        ];
    }
}
