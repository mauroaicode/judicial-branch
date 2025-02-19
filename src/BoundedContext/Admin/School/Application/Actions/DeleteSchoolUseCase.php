<?php

namespace Core\BoundedContext\Admin\School\Application\Actions;

use Core\BoundedContext\Admin\School\{Domain\Exceptions\SchoolNotFoundException,
    Domain\ValueObjects\SchoolId,
    Application\Responses\SchoolResponse,
    Domain\Contracts\SchoolRepositoryContract};

class DeleteSchoolUseCase
{
    public function __construct(private SchoolRepositoryContract $repository){}

    /**
     * Executes the action of eliminating a school.
     *
     * @param string $schoolId The ID of the school to be deleted.
     * @return SchoolResponse The response of the delete action.
     *
     * @throws SchoolNotFoundException If the school with the provided ID is not found.
     */
    public function __invoke(string $schoolId): SchoolResponse
    {
        $id = new SchoolId($schoolId);

        $school = $this->repository->delete($id);

        if (is_null($school)){

            throw new SchoolNotFoundException();
        }

        return SchoolResponse::fromSchool($school);
    }
}
