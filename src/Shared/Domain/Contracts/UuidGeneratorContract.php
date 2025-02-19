<?php

namespace Core\Shared\Domain\Contracts;

interface UuidGeneratorContract {
    public function generate(): string;
}
