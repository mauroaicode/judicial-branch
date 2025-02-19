<?php

namespace Core\BoundedContext\Tenant\IdentificationType\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentificationTypeModel extends Model
{
    use HasFactory;

    protected $table = 'identification_types';
    protected $keyType = 'string';
    public $incrementing = false;

    protected static function newFactory(): IdentificationTypeModelFactory
    {
        return IdentificationTypeModelFactory::new();
    }

}
