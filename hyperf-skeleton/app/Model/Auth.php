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
    protected ?string $table = 'Auth';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = [];
}
