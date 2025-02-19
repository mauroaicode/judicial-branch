<?php

namespace Core\BoundedContext\Admin\School\Application\Actions;

use Core\BoundedContext\Admin\School\Application\Responses\SchoolResponse;
use Core\BoundedContext\Admin\School\Domain\{
    Contracts\SchoolRepositoryContract,
    Exceptions\SchoolNotFoundException,
    ValueObjects\SchoolId};


class FindSchoolUseCase
{
    public function __construct(private SchoolRepositoryContract $repository){}

    /**
     * Find a school by its id and return an answer.
     *
     * @param string $schoolId The id of the school being searched for.
     *
     * @return SchoolResponse The response containing the data for the school found.
     * @throws SchoolNotFoundException If the school is not found in the database.
     */
    public function __invoke(string $schoolId): SchoolResponse
    {
        $id = new SchoolId($schoolId);

        $school = $this->repository->find($id);

        if (is_null($school)) {

            throw new SchoolNotFoundException();
        }

        return SchoolResponse::fromSchool($school);
    }
}
