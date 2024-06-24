<?php

declare(strict_types=1);

namespace App\Model;



/**
 */
class AuditData extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'audit_data';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'key', 'value','object_id', 'audit_action_id'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];
}
