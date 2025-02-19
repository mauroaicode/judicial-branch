<?php

namespace Core\BoundedContext\Tenant\Vehicle\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\{Factories\HasFactory, Model};
use Core\BoundedContext\Tenant\Vehicle\Infrastructure\Database\Factories\VehicleModelFactory;
use Tenancy\Affects\Connections\Support\Traits\OnTenant;

class VehicleModel extends Model
{
    use HasFactory, OnTenant;

    protected $table = 'vehicles';
    protected $keyType = 'string';
    public $incrementing = false;

    const AVAILABLE = 'available';
    const NOT_AVAILABLE = 'not_available';

    protected $guarded = ['id'];
    protected $fillable = ['brand', 'model', 'year', 'badge', 'motor_number', 'create_user_id', 'state'];

    protected static function newFactory(): VehicleModelFactory
    {
        return VehicleModelFactory::new();
    }
}
