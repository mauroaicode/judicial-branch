<?php

namespace Core\BoundedContext\Admin\School\Infrastructure\Persistence\Eloquent;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Tenancy\Identification\Contracts\Tenant;
use Tenancy\Tenant\Events\{Created, Deleted, Updated};
use Tenancy\Identification\Concerns\AllowsTenantIdentification;
use Tenancy\Identification\Drivers\Http\Contracts\IdentifiesByHttp;
use Illuminate\Database\{Eloquent\Builder, Eloquent\Factories\HasFactory, Eloquent\Model};
use Core\BoundedContext\Tenant\Role\Infrastructure\Persistence\Eloquent\RoleModel;

class SchoolModel extends Model implements Tenant, IdentifiesByHttp
{
    use HasFactory, AllowsTenantIdentification;

    protected $table = 'schools';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['name', 'slug'];

    protected $dispatchesEvents = [
        'created' => Created::class,
        'updated' => Updated::class,
        'deleted' => Deleted::class
    ];

    /**
     * Get the name of the "slug" column.
     *
     * @return string
     */
    public function getTenantKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the actual value of the "slug" column for the tenant Model.
     *
     * @return string
     */
    public function getTenantKey(): string
    {
        return $this->slug;
    }

    /**
     * Constructor for SchoolModel.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->setConnection('mysql');
        parent::__construct($attributes);
    }

    /**
     * Identify the tenant by HTTP request.
     *
     * @param Request $request
     * @return Tenant|null
     */
    public function tenantIdentificationByHttp(Request $request): ?Tenant
    {
        if ($request->segment(1) !== 'api') {
            Config::set('permission.models.role',
                RoleModel::class
            );
        }
        return $this->query()
            ->where('slug', $request->segment(1))
            ->first();

    }

    /**
     * Scope to find a tenant by ID.
     *
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeFindById(Builder $query, string $value): Builder
    {
        return $query->where('id', $value);
    }

    /**
     * Scope to find a tenant by slug.
     *
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeFindBySlug(Builder $query, string $value): Builder
    {
        return $query->where('slug', $value);
    }
}
