<?php

namespace Core\BoundedContext\Tenant\Filing\Domain\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FilingWasObtained
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        public string $tenantKey,
        public string $tenantIdentifier,
        public string $filingId,
        public string $processId,
    ) {}
}
