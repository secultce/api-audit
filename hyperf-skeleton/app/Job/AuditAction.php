<?php

declare(strict_types=1);

namespace App\Job;

use Hyperf\AsyncQueue\Job;
use App\Model\AuditAction as AuditActionModel;

class AuditAction extends Job
{
    public function __construct(
        public readonly array $params
    )
    {
    }

    public function handle(): void
    {
        // Process specific logic based on parameters
var_dump($this);
//        AuditActionModel::create($this->params);
    }
}
