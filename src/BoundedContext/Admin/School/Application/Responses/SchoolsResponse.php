<?php

namespace Core\BoundedContext\Admin\School\Application\Responses;

use Core\BoundedContext\Admin\School\Domain\Schools;

final class SchoolsResponse
{

    public function __construct(private array $schools){}

    public static function fromSchools(Schools $schools): SchoolsResponse
    {
        $schoolResponses = array_map(
            function ($school) {
                return SchoolResponse::fromSchool($school);
            },
            $schools->all()
        );
        return new self($schoolResponses);
    }

    public function toArray(): array
    {
        return array_map(function (SchoolResponse $schoolResponse) {
            return $schoolResponse->toArray();
        }, $this->schools);
    }
}
