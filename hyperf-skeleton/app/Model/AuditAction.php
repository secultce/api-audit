<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

/**
 */
class AuditAction extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'audit_action';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id','user_id', 'type','object_id', 'action', 'message'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer'];

}
