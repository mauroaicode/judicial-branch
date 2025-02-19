<?php

namespace Core\BoundedContext\Admin\School\Application\Responses;

use Core\BoundedContext\Admin\School\Domain\School;

final class SchoolResponse
{

    public function __construct(private string $id, private string $name, private string $slug){}

    public static function fromSchool(School $school): self
    {
        return new self(
            $school->id()->value(),
            $school->name()->value(),
            $school->slug()->value(),
        );
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function slug(): string
    {
        return $this->slug;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug
        ];
    }
}
