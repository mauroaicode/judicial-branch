<?php

namespace Core\BoundedContext\Admin\School\Application\Actions;

use Core\BoundedContext\Admin\School\Domain\ValueObjects\{SchoolId, SchoolName, SchoolSlug};
use Core\BoundedContext\Admin\School\{Domain\School, Domain\Contracts\SchoolRepositoryContract, Application\Responses\SchoolResponse};

final class CreateSchoolUseCase
{
    public function __construct(private SchoolRepositoryContract $repository){}

    /**
     * Creates a new school with the provided data and stores it in the repository.
     *
     * @param string $id The unique identifier of the school.
     * @param string $name The school name.
     * @param string $slug The school's slug.
     *
     * @return SchoolResponse A response containing the created school's data.
     */
    public function __invoke(string $id, string $name, string $slug): SchoolResponse
    {
        $id = new SchoolId($id);
        $name = new SchoolName($name);
        $slug = new SchoolSlug($slug);

        $school = School::create($id, $name, $slug);

        $this->repository->save($school);

        return SchoolResponse::fromSchool($school);
    }
}
