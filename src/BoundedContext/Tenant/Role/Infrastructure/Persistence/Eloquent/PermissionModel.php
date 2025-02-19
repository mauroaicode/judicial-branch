<?php

namespace Core\BoundedContext\Tenant\Role\Infrastructure\Persistence\Eloquent;

use Core\Shared\Infrastructure\Traits\Uuid;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Core\BoundedContext\Tenant\User\Infrastructure\Persistence\Eloquent\UserModel;

class PermissionModel extends SpatiePermission
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
    protected $keyType = 'string';

    static public function assignPermissions($user, $permission)
    {
        $user = UserModel::find($user);
        return $user->givePermissionTo($permission->name);

    }
}
