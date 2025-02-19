<?php

namespace Core\BoundedContext\Admin\School\Domain\Contracts;

use Core\BoundedContext\{Admin\School\Domain\School, Admin\School\Domain\Schools, Admin\School\Domain\ValueObjects\SchoolId};

interface SchoolRepositoryContract
{
    public function list(): Schools;

    public function save(School $school): void;

    public function find(SchoolId $schoolId): ?School;

    public function delete(SchoolId $schoolId): ?School;
}
