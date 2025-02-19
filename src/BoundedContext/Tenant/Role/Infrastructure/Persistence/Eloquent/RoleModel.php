<?php

namespace Core\BoundedContext\Tenant\Role\Infrastructure\Persistence\Eloquent;

use Core\Shared\Infrastructure\Traits\Uuid;
use Spatie\Permission\Models\Role as SpatieRole;

class RoleModel extends SpatieRole
{
    use Uuid;

    protected $primaryKey = 'id';
    public $incrementing = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string'
    ];
}
