<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\Contract\StdoutLoggerInterface;
use Psr\Log\LogLevel;

use function Hyperf\Support\env;

$appEnv = env('APP_ENV', 'dev');

$logLevel = [
    LogLevel::ALERT,
    LogLevel::CRITICAL,
    LogLevel::EMERGENCY,
    LogLevel::ERROR,
    LogLevel::INFO,
    LogLevel::NOTICE,
    LogLevel::WARNING,
];

if ($appEnv === 'dev') {
    $logLevel[] = LogLevel::DEBUG;
}

return [
    'app_name' => env('APP_NAME', 'rinha-de-backend'),
    'app_env' => $appEnv,
    'scan_cacheable' => env('SCAN_CACHEABLE', false),
    StdoutLoggerInterface::class => [
        'log_level' => $logLevel,
    ],
];
