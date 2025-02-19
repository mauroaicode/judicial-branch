<?php

namespace Core\BoundedContext\Tenant\User\Infrastructure\Persistence\Eloquent;

use Core\BoundedContext\Tenant\User\Infrastructure\Database\Factories\UserModelFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tenancy\Affects\Connections\Support\Traits\OnTenant;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserModel extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, OnTenant, HasRoles;

    protected $table = 'users';
    protected $keyType = 'string';
    public $incrementing = false;

    const ACTIVE = 'active';
    const INACTIVE = 'inactive';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'phone',
        'phone_two',
        'document',
        'address',
        'gender_id',
        'slug',
        'picture',
        'identification_type_id',
        'email',
        'password',
    ];

    protected $guarded = ['id'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['role_names'];

    public function getRoleNamesAttribute() {
        return $this->roles->pluck('name');
    }

    protected static function newFactory(): UserModelFactory
    {
        return UserModelFactory::new();
    }

    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [
            'group' => data_get($this, 'group'),
            'tenant' => data_get($this->tenant, 'id'),
        ];
    }
}
