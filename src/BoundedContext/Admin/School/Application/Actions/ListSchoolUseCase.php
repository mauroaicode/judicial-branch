<?php

namespace Core\BoundedContext\Admin\School\Application\Actions;

use Core\BoundedContext\Admin\School\{Domain\Contracts\SchoolRepositoryContract, Application\Responses\SchoolsResponse};

final class ListSchoolUseCase
{
    public function __construct(private SchoolRepositoryContract $repository){}

    /**
     * Execute the action to list all the schools available in the system.
     *
     * @return SchoolsResponse A response containing the list of schools.
     */
    public function __invoke(): SchoolsResponse
    {
        $schools = $this->repository->list();

        return SchoolsResponse::fromSchools($schools);
    }
}
