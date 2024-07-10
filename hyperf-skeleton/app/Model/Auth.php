<?php

declare(strict_types=1);

namespace App\Model;



/**
 */
class Auth extends Model
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'auth';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [
        'ip_remote',
        'addr_host',
        'referer',
        'resource_uri',
        'userAgent',
        'createTime',
        'userLogin',
        'action'
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];
}
