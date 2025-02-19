<?php

namespace Core\BoundedContext\Admin\School\Domain;

use Core\BoundedContext\Admin\School\Domain\ValueObjects\{
    SchoolId,
    SchoolName,
    SchoolSlug
};

class School
{
    public function __construct(
        private SchoolId   $id,
        private SchoolName $name,
        private SchoolSlug $slug,
    )
    {
    }

    public static function fromPrimitives(string $id, string $name, string $slug): self
    {
        return new self(
            new SchoolId($id),
            new SchoolName($name),
            new SchoolSlug($slug)
        );
    }
    public static function create(SchoolId $id, SchoolName $name, SchoolSlug $slug): self
    {
        return new self(
            $id,
            $name,
            $slug
        );
    }
    public function id(): SchoolId
    {
        return $this->id;
    }

    public function name(): SchoolName
    {
        return $this->name;
    }

    public function slug(): SchoolSlug
    {
        return $this->slug;
    }
}
