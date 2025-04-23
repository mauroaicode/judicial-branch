<?php

namespace Core\BoundedContext\Tenant\Process\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\{
    Model,
    Relations\BelongsTo
};
use Tenancy\Affects\Connections\Support\Traits\OnTenant;
use Core\BoundedContext\Tenant\Filing\Infrastructure\Persistence\Eloquent\FilingModel;


class ProcessModel extends Model
{
    use OnTenant;

    protected $table = 'processes';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = ['id'];
    protected $fillable = [
        'id',
        'process_id',
        'filing_code',
        'connection_id',
        'is_private',
        'process_date',
        'full_docket_code',
        'court',
        'judge',
        'process_type',
        'process_class',
        'process_subclass',
        'appeal_type',
        'location',
        'filing_content',
        'consulted_at',
        'last_updated_at',
        'filing_id',
    ];

    public function filing(): BelongsTo
    {
        return $this->belongsTo(FilingModel::class);
    }
}
