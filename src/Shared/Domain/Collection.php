<?php

declare(strict_types=1);

namespace Core\Shared\Domain;

use Core\Shared\Domain\Contracts\CollectionContract;

abstract class Collection implements CollectionContract
{
    public function __construct(private array $items = []) {}

    public function all(): array {
        return $this->items;
    }
}
