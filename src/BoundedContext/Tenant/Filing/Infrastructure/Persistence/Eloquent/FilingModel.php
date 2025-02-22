<?php

namespace Core\BoundedContext\Tenant\Filing\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model
};
use Core\BoundedContext\Tenant\Filing\Infrastructure\Database\Factories\FilingModelFactory;
use Tenancy\Affects\Connections\Support\Traits\OnTenant;

class FilingModel extends Model
{
    use HasFactory, OnTenant;

    protected $table = 'filings';
    protected $keyType = 'string';
    public $incrementing = false;

    const AVAILABLE = 'available';
    const NOT_AVAILABLE = 'not_available';

    protected $guarded = ['id', 'code'];
    protected $fillable = [];

    protected static function newFactory(): FilingModelFactory
    {
        return FilingModelFactory::new();
    }
}
