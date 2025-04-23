<?php

namespace Core\BoundedContext\Admin\Customer\Infrastructure\Persistence\Eloquent;

use Core\BoundedContext\Admin\Customer\Domain\{
    Contracts\CustomerRepositoryContract,
    Customer,
    Customers,
    ValueObjects\CustomerId
};
use Core\Shared\Domain\Contracts\TransactionContract;
use Exception;

class EloquentCustomerRepository implements CustomerRepositoryContract
{

    public function __construct(private CustomerModel $model, private TransactionContract $transactionContract)
    {
    }

    /**
     * Converts an Eloquent customer model into a customer domain instance.
     *
     * @param CustomerModel $eloquentCustomerModel The Eloquent customer model to convert.
     *
     * @return Customer A domain instance representing the customer.
     */
    private function toDomain(CustomerModel $eloquentCustomerModel): Customer
    {
        return Customer::fromPrimitives(
            $eloquentCustomerModel->id,
            $eloquentCustomerModel->name,
            $eloquentCustomerModel->slug,
        );
    }

    public function toEloquent(Customer $customer): ?CustomerModel
    {
        return new CustomerModel([
            'id' => $customer->id()->value(),
            'name' => $customer->name()->value(),
            'slug' => $customer->slug()->value(),
        ]);
    }

    /**
     * Gets a list of customers from the database and converts it into a set of domain instances.
     *
     * @return Customers A set of domain instances representing customers.
     */
    public function list(): Customers
    {
        $customerModel = $this->model->orderBy('created_at', 'DESC')->get();

        $customers = $customerModel->map(
            function (CustomerModel $customerModel) {
                return $this->toDomain($customerModel);
            }
        )->toArray();

        return new Customers($customers);
    }

    /**
     * Stores a customer in the database.
     *
     * @param Customer $customer The instance of the customer to be stored.
     */
    public function save(Customer $customer): void
    {
        $this->transactionContract->beginTransaction();

        $customerModel = $this->model->find($customer->id()->value());

        if (is_null($customerModel)) {

            $customerModel = new CustomerModel();
            $customerModel->id = $customer->id()->value();
        }

        try {

            $customerModel->name = $customer->name()->value();
            $customerModel->slug = $customer->slug()->value();
            $customerModel->save();

            $this->transactionContract->commit();

        } catch (Exception $e) {

            $this->transactionContract->rollback();
        }
    }

    /**
     * Searches for a customer by its id in the database and returns a domain instance.
     *
     * @param CustomerId $customerId The id of the customer being searched for.
     *
     * @return Customer|null A Customer domain instance if found, or null if not found.
     */
    public function find(CustomerId $customerId): ?Customer
    {
        $customerModel = $this->model->find($customerId->value());

        if (is_null($customerModel)) {
            return null;
        }

        return $this->toDomain($customerModel);
    }


    /**
     * Removes a customer from the database by its ID.
     *
     * @param CustomerId $customerId The ID of the customer to be deleted.
     *
     * @return Customer|null A domain instance of the customer removed if found, or null if not found.
     */
    public function delete(CustomerId $customerId): ?Customer
    {
        $customerModel = $this->model->find($customerId->value());

        if (is_null($customerModel)) {
            return null;
        }

        $this->transactionContract->beginTransaction();

        try {

            $customerModel->delete();

            $this->transactionContract->commit();

        } catch (Exception $e) {

            $this->transactionContract->rollback();
        }

        return $this->toDomain($customerModel);
    }
}
