<?php

namespace Core\BoundedContext\Admin\School\Infrastructure\Persistence\Eloquent;

use Core\BoundedContext\Admin\School\Domain\{
    Contracts\SchoolRepositoryContract,
    School,
    Schools,
    ValueObjects\SchoolId
};
use Core\Shared\Domain\Contracts\TransactionContract;
use Exception;

class EloquentSchoolRepository implements SchoolRepositoryContract
{

    public function __construct(private SchoolModel $model, private TransactionContract $transactionContract)
    {
    }

    /**
     * Converts an Eloquent school model into a school domain instance.
     *
     * @param SchoolModel $eloquentSchoolModel The Eloquent school model to convert.
     *
     * @return School A domain instance representing the school.
     */
    private function toDomain(SchoolModel $eloquentSchoolModel): School
    {
        return School::fromPrimitives(
            $eloquentSchoolModel->id,
            $eloquentSchoolModel->name,
            $eloquentSchoolModel->slug,
        );
    }

    /**
     * Gets a list of schools from the database and converts it into a set of domain instances.
     *
     * @return Schools A set of domain instances representing schools.
     */
    public function list(): Schools
    {
        $schoolModel = $this->model->orderBy('created_at', 'DESC')->get();

        $schools = $schoolModel->map(
            function (SchoolModel $schoolModel) {
                return $this->toDomain($schoolModel);
            }
        )->toArray();

        return new Schools($schools);
    }

    /**
     * Stores a school in the database.
     *
     * @param School $school The instance of the school to be stored.
     */
    public function save(School $school): void
    {
        $this->transactionContract->beginTransaction();

        $schoolModel = $this->model->find($school->id()->value());

        if (is_null($schoolModel)) {

            $schoolModel = new SchoolModel();
            $schoolModel->id = $school->id()->value();
        }

        try {

            $schoolModel->name = $school->name()->value();
            $schoolModel->slug = $school->slug()->value();
            $schoolModel->save();

            $this->transactionContract->commit();

        } catch (Exception $e) {

            $this->transactionContract->rollback();
        }
    }

    /**
     * Searches for a school by its id in the database and returns a domain instance.
     *
     * @param SchoolId $schoolId The id of the school being searched for.
     *
     * @return School|null A School domain instance if found, or null if not found.
     */
    public function find(SchoolId $schoolId): ?School
    {
        $schoolModel = $this->model->find($schoolId->value());

        if (is_null($schoolModel)) {
            return null;
        }

        return $this->toDomain($schoolModel);
    }

    /**
     * Removes a school from the database by its ID.
     *
     * @param SchoolId $schoolId The ID of the school to be deleted.
     *
     * @return School|null A domain instance of the school removed if found, or null if not found.
     */
    public function delete(SchoolId $schoolId): ?School
    {
        $schoolModel = $this->model->find($schoolId->value());

        if (is_null($schoolModel)) {
            return null;
        }

        $this->transactionContract->beginTransaction();

        try {

            $schoolModel->delete();

            $this->transactionContract->commit();

        } catch (Exception $e) {

            $this->transactionContract->rollback();
        }

        return $this->toDomain($schoolModel);
    }
}
