<?php

namespace Core\Shared\Infrastructure\Handlers;

use Core\Shared\Domain\Contracts\UuidGeneratorContract;
use Ramsey\Uuid\Uuid as RamseyUuid;

final class RamseyUuidGenerator implements UuidGeneratorContract {
    public function generate(): string {
        return RamseyUuid::uuid4()->toString();
    }
}
