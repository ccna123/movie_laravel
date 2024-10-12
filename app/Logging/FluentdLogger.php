<?php

namespace App\Logging;

use Fluent\Logger\FluentLogger;
use Monolog\Handler\FluentHandler;
use Monolog\Logger;

class FluentdLogger
{
    public function __invoke(array $config)
    {
        $host = env('FLUENTD_HOST', 'localhost');
        $port = env('FLUENTD_PORT', 24224);

        $fluentLogger = new FluentLogger($host, $port);
        $handler = new FluentHandler($fluentLogger);

        return new Logger('fluentd', [$handler]);
    }
}

