<?php

namespace Core\BoundedContext\Tenant\GenderIdentity\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenderIdentityModel extends Model
{
    use HasFactory;

    protected $table = 'gender_identities';
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function newFactory(): GenderIdentityModelFactory
    {
        return GenderIdentityModelFactory::new();
    }
}
